<?php
/**
 * User: minms
 */

namespace minms\pospal\pimple;

class AbstractAPI extends Container
{

    protected $isLastPage = false;
    /**
     * @var Config
     */
    private $config;

    public function __construct(Config $config)
    {
        $this->setConfig($config);
    }

    /**
     * 设置配置
     *
     * @param Config $config
     */
    protected function setConfig(Config $config)
    {
        $this->config = $config;
    }

    /**
     * 获取配置
     *
     * @return Config
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * 发起API请求
     *
     * @param $url
     * @param array $sendData
     * @param bool $json
     * @return array
     * @throws PospalException
     */
    protected function doApiRequest($url, array $sendData, $json = true)
    {
        if (strpos($url, 'http://') === false) {
            $url = rtrim($this->config->base_uri, '/') . '/' . ltrim($url, '/');
        }

        if (!isset($sendData['appId'])) {
            $sendData['appId'] = $this->config->app_id;
        }
        if (!is_null($this['postBackParameter'])) {
            $sendData['postBackParameter'] = $this['postBackParameter'];
        }


        $jsondata = json_encode($sendData);
        $signature = strtoupper(md5($this->config->app_key . $jsondata));

        $result = $this->httpsRequest($url, $jsondata, $signature, $json);

        //\Yii::trace($result);
        if ($result['status'] != 'success') {
            throw new PospalException($result['errorCode']);
        }

        $data = isset($result['data']) ? $result['data'] : [];
        if (isset($data['postBackParameter'])) {
            $this['postBackParameter'] = $data['postBackParameter'];
        }

        if (isset($data['result'])) {
            if (isset($data['pageSize']) && count($data['result']) < $data['pageSize']) {
                $this->isLastPage = true;
            }
        }

        return isset($data['result']) ? $data['result'] : $data;
    }

    public function getIsLastPage()
    {
        return $this->isLastPage;
    }

    // 模拟提交数据函数
    private function httpsRequest($url, $data, $signature, $json = true)
    {
        $time = time();
        $curl = curl_init();// 启动一个CURL会话
        // 设置HTTP头
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "User-Agent: openApi",
            "Content-Type: application/json; charset=utf-8",
            "accept-encoding: gzip,deflate",
            "time-stamp: " . $time,
            "data-signature: " . $signature
        ));
        curl_setopt($curl, CURLOPT_URL, $url);         // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);        // Post提交的数据包
        //curl_setopt($curl, CURLOPT_PROXY, '127.0.0.1:8888');//设置代理服务器,此处用的是fiddler，可以抓包分析发送与接收的数据
        curl_setopt($curl, CURLOPT_POST, 1);        // 发送一个常规的Post请求

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);// 获取的信息以文件流的形式返回
        $output = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            throw new PospalException('Pospal Http Error: ' . curl_errno($curl));//捕抓异常
        }
        curl_close($curl); // 关闭CURL会话

        return $json ? json_decode($output, true) : $output; // 返回数据
    }
}
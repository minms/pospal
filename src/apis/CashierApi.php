<?php
/**
 * User: minms
 */

namespace minms\pospal\apis;

use minms\pospal\pimple\AbstractAPI;

class CashierApi extends AbstractAPI
{
    /**
     * 统一构建地址
     * @param $api string 接口名称
     * @param array $sendData 发送数据
     * @param bool $json 是否序列化JSON
     * @return array 返回数据
     */
    protected function doApiRequest($api, array $sendData, $json = true)
    {
        $url = '/pospal-api2/openapi/v1/cashierOpenApi/' . $api;
        return parent::doApiRequest($url, $sendData, $json);
    }

    /**
     * 1. 获取门店所有收银员
     *
     * @return array
     */
    public function queryAllCashier()
    {
        $this->doApiRequest(__FUNCTION__, [

        ]);
    }
}
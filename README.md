# pospal
银豹商超系统PHP接口

## 使用方法
```
use minms\pospal\PospalClient;

$client = new PospalClient([
    'base_uri' => 'https://area14-win.pospal.cn:443/',
    'app_id' => 'appid',
    'app_key' => 'appkey'
]);

//获取商超系统商品
$result = [];
while (true) {
    //获取单页
    $pageResult = $client->product->queryProductPages();
    //Yii::trace($pageResult);
    //合并
    $result += $pageResult;
    //最后一页退出
    if ($client->product->getIsLastPage()) {
        break;
    }
}

//获取商超系统销售单据
$result = [];
while (true) {
    //获取单页
    $pageResult = $client->ticket->queryTicketPages(date('Y-m-d H:i:s', $stime), date('Y-m-d H:i:s', $etime));
    //Yii::trace($pageResult);
    //合并
    $result += $pageResult;
    //最后一页退出
    if ($client->ticket->getIsLastPage()) {
        break;
    }
}

//根据会员号查询会员
$info = $client->member->queryByNumber('13800138000');
```

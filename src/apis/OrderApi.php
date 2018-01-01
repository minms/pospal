<?php
/**
 * User: minms
 */

namespace minms\pospal\apis;

use minms\pospal\pimple\AbstractAPI;

class OrderApi extends AbstractAPI
{
    /**
     * 统一构建地址
     * @param $api
     * @param array $sendData
     * @param bool $json
     * @return array
     */
    protected function doApiRequest($api, array $sendData, $json = true)
    {
        $url = '/pospal-api2/openapi/v1/orderOpenApi/' . $api;
        return parent::doApiRequest($url, $sendData, $json);
    }

    /**
     * 2.新增在线订单
     * @param string $payMethod 两种支付方式二选一：Cash,表示现金支付；
     * CustomerBalance,表示用会员余额支付,接口会根据customerNumber去扣除对应会员的余额；
     * @param string $customerNumber 会员号，订单是哪个会员下的。如果payMethod= CustomerBalance，参数customerNumber不能为空
     * @param int $shippingFee 运费
     * @param string $orderRemark 订单备注
     * @param string $orderDateTime 订单产生的时间，格式为yyyy-MM-dd hh:mm:ss
     * @param string $contactAddress 送货地址，联系地址
     * @param string $contactName 联系人姓名
     * @param string $contactTel 联系人电话
     * @param array $items 商品明细, 多为数组
     * @return array
     */
    public function addOnLineOrder($payMethod, $customerNumber, $shippingFee, $orderRemark, $orderDateTime, $contactAddress
        , $contactName, $contactTel, $items)
    {
        $this->doApiRequest(__FUNCTION__, [
            'payMethod' => $payMethod,
            'customerNumber' => $customerNumber,
            'shippingFee' => $shippingFee,
            'orderRemark' => $orderRemark,
            'orderDateTime' => $orderDateTime,
            'contactAddress' => $contactAddress,
            'contactName' => $contactName,
            'contactTel' => $contactTel,
            'items' => $items,
        ]);
    }

    /**
     * 3.取消在线订单
     * @param string $orderNo 联系人电话
     * @return array
     */
    public function cancleOrder($orderNo)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'orderNo' => $orderNo
        ]);
    }

    /**
     * 4.在线订单发货
     * @param string $orderNo 联系人电话
     * @return array
     */
    public function shipOrder($orderNo)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'orderNo' => $orderNo
        ]);
    }

    /**
     * 5.完成在线订单
     * @param string $orderNo 联系人电话
     * @param  bool $shouldAddTicket 是否在银豹收银系统生成流水单据
     * @return array
     */
    public function completeOrder($orderNo, $shouldAddTicket)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'orderNo' => $orderNo,
            'shouldAddTicket' => $shouldAddTicket
        ]);
    }
}
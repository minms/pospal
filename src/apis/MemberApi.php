<?php
/**
 * User: minms
 */

namespace minms\pospal\apis;

use minms\pospal\pimple\AbstractAPI;

class MemberApi extends AbstractAPI
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
        $url = '/pospal-api2/openapi/v1/customerOpenApi/' . $api;
        return parent::doApiRequest($url, $sendData, $json);
    }

    /**
     * 1. 根据会员号查询会员
     *
     * @param string $customerNum 会员号
     * @return mixed|array
     */
    public function queryByNumber($customerNum)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'customerNum' => $customerNum
        ]);
    }

    /**
     *  2.根据会员在银豹系统的唯一标识查询
     *
     * @param string $customerUid 会员在银豹系统的唯一标识
     * @return mixed|array
     */
    public function queryByUid($customerUid)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'customerUid' => $customerUid
        ]);
    }

    /**
     *  3.批量查询用户，根据上次请求结果自动循环， 返回空数组为请求完成
     *
     * @return array
     */
    public function queryCustomerPages()
    {
        return $this->doApiRequest(__FUNCTION__, [
            'postBackParameter' => $this['postBackParameter']
        ]);
    }

    /**
     *  4.修改会员基本信息
     *
     * @param array $customerInfo 会员信息
     * @return bool|mixed
     */
    public function updateBaseInfo($customerInfo)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'customerInfo' => $customerInfo
        ]);
    }

    /**
     *  5.修改会员余额积分
     *
     * @param int $customerUid 会员在银豹系统的唯一标识
     * @param float $balanceIncrement 金额增长量,修改结果为银豹系统中的会员余额+balanceIncrement
     * @param float $pointIncrement 积分增长量, 修改结果为银豹系统中的会员积分+pointIncrement
     * @return array
     */
    public function updateBalancePointByIncrement($customerUid, $balanceIncrement = 0.0, $pointIncrement = 0.0)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'customerUid' => $customerUid,
            'balanceIncrement' => $balanceIncrement,
            'pointIncrement' => $pointIncrement,
            'dataChangeTime' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     *  6.添加会员
     *
     * @param array $customerInfo
     * @return array
     */
    public function add($customerInfo)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'customerInfo' => $customerInfo
        ]);
    }

    /**
     *  7.查询全部通用金额充值记录
     *
     * @param string $stateDate 开始时间，格式为yyyy-MM-dd hh:mm:ss,不包含开始时间
     * @param string $endDate 结束时间，格式为yyyy-MM-dd hh:mm:ss,包含结束时间endDate – startDate <=31天
     * @return array
     */
    public function queryAllRechargeLogs($stateDate, $endDate)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'stateDate' => $stateDate,
            'endDate' => $endDate
        ]);
    }

    /**
     * 8. 会员通用金额充值日志查询
     *
     * @param int $customerUid 会员在银豹收银系统的唯一标识
     * @return array
     */
    public function queryCustomerRechargeLog($customerUid)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'customerUid' => $customerUid
        ]);
    }

    /**
     * 9. 根据会员手机号查询会员
     *
     * @param string $customerTel 会员手机号
     * @return array 如果多个会员的手机号相同，可能返回多条记录
     */
    public function queryBytel($customerTel)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'customerTel' => $customerTel
        ]);
    }

}
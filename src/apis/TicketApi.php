<?php
/**
 * User: minms
 */

namespace minms\pospal\apis;

use minms\pospal\pimple\AbstractAPI;

class TicketApi extends AbstractAPI
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
        $url = '/pospal-api2/openapi/v1/ticketOpenApi/' . $api;
        return parent::doApiRequest($url, $sendData, $json);
    }

    /**
     * 1. 查询支付方式代码
     * @return array
     */
    public function queryAllPayMethod()
    {
        return $this->doApiRequest(__FUNCTION__, [

        ]);
    }

    /**
     * 2. 根据单据序列号查询
     *
     * @param int @sn 单据序列号
     * @return array
     */
    public function queryTicketBySn($sn)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'sn' => $sn
        ]);
    }

    /**
     * 3. 分页查询所有单据
     *
     * @param string $startDate 开始时间，格式为yyyy-MM-dd hh:mm:ss,不包含开始时间
     * @param string $endDate 结束时间，格式为yyyy-MM-dd hh:mm:ss,包含结束时间endDate – startDate <=31天
     * @return array
     */
    public function queryTicketPages($startDate, $endDate)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'endTime' => $endDate,
            'startTime' => $startDate
        ]);
    }
}
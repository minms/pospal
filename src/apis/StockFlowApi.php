<?php
/**
 * User: minms
 */

namespace minms\pospal\apis;

use minms\pospal\pimple\AbstractAPI;

class StockFlowApi extends AbstractAPI
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
        $url = '/pospal-api2/openapi/v1/stockFlowOpenApi/' . $api;
        return parent::doApiRequest($url, $sendData, $json);
    }

    /**
     * 2.分页查询所有订货单(所有门店创建的订货单)
     * @param string $startTime 开始时间（包含），格式为yyyy-MM-dd hh:mm:ss
     * @param string $excludeEndTime 结束时间（不包含），格式为yyyy-MM-dd hh:mm:ssendTime - startTime <= 5天
     * @return array
     */
    public function queryProductRequestPages($startTime, $excludeEndTime)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'startTime' => $startTime,
            'excludeEndTime' => $excludeEndTime
        ]);
    }

    /**
     * 3. 根据Id订货单
     * @param int $productReuestId 订货单ID
     * @return array
     */
    public function queryProductRequestById($productReuestId)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'productReuestId' => $productReuestId
        ]);
    }

    /**
     * 4. 分页查询所有货单（调货\进货\退货）（所有门店创建的贷流单）
     * @param string $startTime 开始时间（包含），格式为yyyy-MM-dd hh:mm:ss
     * @param string $excludeEndTime 结束时间（不包含），格式为yyyy-MM-dd hh:mm:ssendTime - startTime <= 5天
     * @return array
     */
    public function queryStockFlowPages($startTime, $excludeEndTime)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'startTime' => $startTime,
            'excludeEndTime' => $excludeEndTime
        ]);
    }

    /**
     * 5. 根据订货单id查询所有单（调货\进货\退货）
     * @param int $productReuestId 订货单ID
     * @return array
     */
    public function queryStockFlowDetailByProductReuqestId($productReuestId)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'productReuestId' => $productReuestId
        ]);
    }

    /**
     * 6. 根据货单id查询货单
     * @param int $stockFlowId 货流单ID
     * @return array
     */
    public function queryStockFlowDetailById($stockFlowId)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'stockFlowId' => $stockFlowId
        ]);
    }
}
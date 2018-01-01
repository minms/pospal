<?php
/**
 * User: minms
 */

namespace minms\pospal\apis;

use minms\pospal\pimple\AbstractAPI;

class PromotionApi extends AbstractAPI
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
        $url = '/pospal-api2/openapi/v1/promotionOpenApi/' . $api;
        return parent::doApiRequest($url, $sendData, $json);
    }

    /**
     * 2.根据优惠券规则Uid查询
     * @param string $promotionCouponUid 优惠券规则uid
     * @return array
     */
    public function queryCouponPromotionByUid($promotionCouponUid)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'promotionCouponUid' => $promotionCouponUid
        ]);
    }

    /**
     * 3. 查询可用优惠券规则
     * @return array
     */
    public function queryCouponPromotions()
    {
        return $this->doApiRequest(__FUNCTION__, []);
    }

    /**
     * 4. 添加优惠券号（核销码）
     * @param string $code 优惠券号（核销码），长度不能超过50(限英文或数字)注：优惠券号（核销码）必须保证每家门店全局唯一。
     * @param int $customerUid 会员Uid，如果有值，说明优惠券号挂到会员上
     * @param int $promotionCouponUid 优惠券规则uid
     * @return array
     */
    public function addCouponcode($code, $customerUid, $promotionCouponUid)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'promotionCouponUid' => $promotionCouponUid,
            'code' => $code,
            'customerUid' => $customerUid
        ]);
    }

    /**
     * 5.分页查询会员所有优惠券号（核销码）(id倒序)
     * @param int $customerUid 会员uid
     * @return array
     */
    public function queryCustomerCouponCodePage($customerUid)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'customerUid' => $customerUid
        ]);
    }

    /**
     * 6. 分页查询核销过的优惠券号（核销码）(id倒序)
     * @param string $startTime 开始时间（包含），格式为yyyy-MM-dd hh:mm:ss
     * @param string $excludeEndTime 结束时间（不包含），格式为yyyy-MM-dd hh:mm:ssendTime - startTime <= 5天
     * @return array
     */
    public function queryUsedPromotionCode($startTime, $excludeEndTime)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'startTime' => $startTime,
            'excludeEndTime' => $excludeEndTime
        ]);
    }
}
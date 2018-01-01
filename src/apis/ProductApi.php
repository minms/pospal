<?php
/**
 * User: minms
 */

namespace minms\pospal\apis;

use minms\pospal\pimple\AbstractAPI;
use minms\pospal\pimple\Config;

class ProductApi extends AbstractAPI
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
        $url = '/pospal-api2/openapi/v1/productOpenApi/' . $api;
        return parent::doApiRequest($url, $sendData, $json);
    }

    /**
     * 1. 分页查询全部商品分类
     *
     * @return array
     */
    public function queryProductCategoryPages()
    {
        return $this->doApiRequest(__FUNCTION__, []);
    }

    /**
     * 2. 分页查询全部商品图片
     * @return array
     */
    public function queryProductImagePages()
    {
        return $this->doApiRequest(__FUNCTION__, []);
    }

    /**
     * 3. 根据条形码查询商品信息
     *
     * @param String $barcode 商品条码
     * @return array
     */
    public function queryProductByBarcode($barcode)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'barcode' => $barcode
        ]);
    }

    /**
     * 4. 分页查询全部商品信息
     *
     * @return array
     */
    public function queryProductPages()
    {
        return $this->doApiRequest(__FUNCTION__, [
            'postBackParameter' => $this['postBackParameter']
        ]);
    }

    /**
     * 5. 修改商品信息
     * @param array $productInfo
     * @return array
     */
    public function updateProductInfo($productInfo)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'productInfo' => $productInfo
        ]);
    }

    /**
     * 6. 根据唯一标识查询商品信息
     * @param int $customerUid 会员在银豹系统的唯一标识
     * @return array
     */
    public function queryProductByUid($customerUid)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'customerUid' => $customerUid
        ]);
    }

    /**
     * 7. 新增加商品信息
     * @param array $customerInfo
     * @return array
     */
    public function addProductInfo($customerInfo)
    {
        return $this->doApiRequest(__FUNCTION__, [
            'customerInfo' => $customerInfo
        ]);
    }
}
<?php
/**
 * User: minms
 */

namespace minms\pospal;

use minms\pospal\apis\CashierApi;
use minms\pospal\apis\MemberApi;
use minms\pospal\apis\OrderApi;
use minms\pospal\apis\ProductApi;
use minms\pospal\apis\PromotionApi;
use minms\pospal\apis\StockFlowApi;
use minms\pospal\apis\TicketApi;
use minms\pospal\pimple\Config;
use minms\pospal\pimple\Container;

/**
 * The Pospal Api Client
 *
 * @package minms\pospal
 *
 * @property Config $config                     Pospal API 参数配置
 * @property MemberApi $member                  会员API
 * @property ProductApi $product                商品API
 * @property TicketApi $ticket                  销售单据API
 * @property CashierApi $cashier                收银员API
 * @property OrderApi $order                    订单推送API
 * @property PromotionApi $promotion            促销(优惠券)API
 * @property StockFlowApi $stockFlow            货流API
 */
class PospalClient extends Container
{
    /**
     * API列表
     *
     * @var array
     */
    protected $apis = [
        'member' => MemberApi::class,
        'product' => ProductApi::class,
        'ticket' => TicketApi::class,
        'cashier' => CashierApi::class,
        'order' => OrderApi::class,
        'promotion' => PromotionApi::class,
        'stockFlow' => StockFlowApi::class
    ];

    /**
     * Client constructor.
     *
     * @param Config|array $config
     */
    public function __construct($config)
    {
        if (is_array($config)) {
            $config = new Config($config);
        }

        $this['config'] = $config;

        $this->registerApis();
    }

    /**
     * 注册所有API
     */
    public function registerApis()
    {
        foreach ($this->apis as $name => $api) {
            $di = $this;
            $this->$name = function () use ($di, $api) {
                return new $api($di['config']);
            };
        }
    }

    /**
     * 获取API或属性
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    /**
     * 设置API或属性
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }
}
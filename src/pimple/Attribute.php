<?php
/**
 * User: minms
 */

namespace minms\pospal\pimple;

class Attribute
{
    private $attributes = [];

    /**
     * @var array
     */
    protected $required = [];

    /**
     * Attribute constructor.
     *
     * @param array $configs
     */
    public function __construct($configs = [])
    {
        foreach ($configs as $k => $config) {
            $this->$k = $config;
        }
    }

    /**
     * Auto set attribute
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
        $this->$name = $value;
    }

    /**
     * Get attribute value
     *
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }
}
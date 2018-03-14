<?php

namespace helpers;

/**
 * Class Config
 * @package helpers
 */
class Config
{
    /**
     * @var null|Config
     */
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return Config|null
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private $data = [];

    /**
     * @param array $data
     */
    public function set(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     * @param null|mixed $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        $keyParts = explode('.', $key);

        $result = $this->data;
        foreach ($keyParts as $part) {
            if (!is_array($result)) {
                return $default;
            }

            $result = array_key_exists($part, $result) ? $result[$part] : $default;
        }

        return $result;
    }
}

<?php

namespace components;

/**
 * Class Application
 * @package components
 */
class Application
{
    /**
     * @var array
     */
    private static $elements = [];

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        self::$elements[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public static function get($key)
    {
        if (array_key_exists($key, self::$elements)) {
            return self::$elements[$key];
        }

        throw new \Exception("Element '{$key}' is not registered");
    }
}
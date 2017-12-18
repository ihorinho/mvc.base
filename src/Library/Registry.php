<?php
/**
 * Created by PhpStorm.
 * User: ihorinho
 * Date: 12/31/16
 * Time: 12:47 AM
 */
namespace Library;

/**
 * Class Registry
 * @package Library
 */
abstract class Registry
{
    /**
     * @var array
     */
    private static $register = [];

    /**
     * @param $key
     * @param $value
     */
    public static function addToRegister($key, $value) {
       self::$register[$key] = $value;
    }

    /**
     * @param $key
     * @return bool|mixed
     */
    public static function get($key)
    {
        if (!array_key_exists($key, self::$register))
            return false;
        return self::$register[$key];
    }
}
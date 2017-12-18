<?php

namespace Library;

/**
 * Class Container
 * @package Library
 */
class Container
{

    /**
     * @var array
     */
    private $services = [];

    /**
     * @param string|integer $key
     * @return mixed
     * @throws \Exception
     */
    public function get($key)
    {
        if(!isset($this->services[$key]))
            throw new \Exception("Entity {$key} not found");
        return $this->services[$key];
    }

    /**
     * @param string|integer $key
     * @param $entity
     * @return $this
     */
    public function set($key, $entity)
    {
        $this->services[$key] = $entity;
        return $this;
    }
}
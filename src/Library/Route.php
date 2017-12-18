<?php

namespace  Library;

/**
 * Class Route
 * @package Library
 */
class Route
{
    /**
     * @var
     */
    public $pattern;
    /**
     * @var
     */
    public $controller;
    /**
     * @var
     */
    public $action;
    /**
     * @var array
     */
    public $params;
    /**
     * @var array
     */
    public $methods;

    /**
     * Route constructor.
     * @param $pattern
     * @param $controller
     * @param $action
     * @param array $params
     * @param array $methods
     */
    public function __construct($pattern, $controller, $action, $params = [], $methods = [])
    {
        $this->pattern = $pattern;
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
        $this->methods = $methods;
    }
}
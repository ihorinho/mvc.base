<?php

namespace  Library;

class Route
{
    public $pattern;
    public $controller;
    public $action;
    public $params;
    public $methods;

    public function __construct($pattern, $controller, $action, $params = [], $methods = [])
    {
        $this->pattern = $pattern;
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
        $this->methods = $methods;
    }
}
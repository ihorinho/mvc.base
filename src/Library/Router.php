<?php

namespace Library;

use Library\Exception\ApiException;

/**
 * Class Router
 * @package Library
 */
class Router
{
    /**
     * @var
     */
    private $routes;
    /**
     * @var
     */
    private $allowedMethods;
    /**
     * @var bool
     */
    private $apiRequest = false;
    /**
     * @var
     */
    private $CurrentRoute;

    /**
     * Router constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->allowedMethods = $config->get('api_methods');
        $routes_arr = $config->get('routes');
        foreach($routes_arr as $route){
            $route_params = isset($route['params']) ? $route['params'] : [];
            $route_methods = isset($route['methods']) ? $route['methods'] : $this->allowedMethods['default'];
            $this->routes[] = new Route($route['pattern'], $route['controller'], $route['action'],
                                            $route_params, $route_methods);
        }
    }

    /**
     * @return mixed
     */
    public function getCurrentRoute()
    {
        return $this->CurrentRoute;
    }

    /**
     * @param Request $request
     * @return $this
     * @throws ApiException
     * @throws \Exception
     */
    public function match(Request $request)
    {
        $path_parts = explode('?', $request->getUri());
        $uri = $path_parts[0];

        if (strpos($uri, '/api/') !== false) {
            $this->apiRequest = true;
            $method = strtolower($request->getMethod());
        }
        if (strpos($uri, '/admin') !== false) {
            Controller::setLayout('admin_layout.phtml.twig');
        }

        foreach ($this->routes as $route) {
            $pattern = '@^' . $route->pattern . '$@';
            foreach ($route->params as $key => $value) {
                $pattern = str_replace('{' . $key . '}' , $value, $pattern);
            }
            if (preg_match($pattern, $uri, $match)) {
                if ($this->apiRequest) {
                    if (!$this->isAllowedMethod($method, $route->pattern)) {
                        throw new \Exception('Method not allowed');
                    }
                    if (!in_array($method, $route->methods)) {
                        continue;
                    }
                }
                $this->CurrentRoute = $route;
                array_shift($match);
                $params = array_combine(array_keys($route->params), $match);
                $request->mergeGet($params);
                break;
            }
        }
        if (empty($this->CurrentRoute)) {
            if ($this->apiRequest) {
                throw new ApiException('Bad request');
            }
            throw new \Exception('404 Page Not Found');
        }
        return $this;
    }

    /**
     * @param $method
     * @param $pattern
     * @return bool
     */
    public function isAllowedMethod($method, $pattern)
    {
       if (!in_array($method, $this->allowedMethods[$pattern]) )
           return false;
       return true;
    }

    /**
     * @param $to
     */
    public function redirect($to)
    {
        header("Location: {$to}");
        die;
    }
}
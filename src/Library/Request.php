<?php
namespace Library;

/**
 * Class Request
 * @package Library
 */
class Request{
    /**
     * @var
     */
    private $get;
    /**
     * @var
     */
    private $post;
    /**
     * @var
     */
    private $server;
    /**
     * @var Session
     */
    private $session;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->session = new Session();
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * @return string
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? 'post' : 'get';
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function get($key, $default = null)
    {
        return isset($this->get[$key]) ? $this->get[$key] : $default;
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function post($key, $default = null)
    {
        return isset($this->post[$key]) ? $this->post[$key] : $default;
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function server($key, $default = null)
    {
        return isset($this->server[$key]) ? $this->server[$key] : $default;
    }

    /**
     * @return null
     */
    public function getIpAddress()
    {
        return $this->server('REMOTE_ADDR');
    }

    /**
     * @return null
     */
    public function getMethod()
    {
        return $this->server('REQUEST_METHOD');
    }

    /**
     * @return null
     */
    public function getUri()
    {
        return $this->server('REQUEST_URI');
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param $array
     */
    public function mergeGet($array)
    {
        $this->get += $array;
    }

    /**
     * @param $name
     * @return null
     */
    public function getCookie($name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    /**
     * @param $name
     * @param $value
     * @param int $expire
     */
    public function setCookie($name, $value, $expire = 3600)
    {
        setcookie($name, $value, time() + $expire, '/');
    }
}
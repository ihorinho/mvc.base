<?php

namespace Library;

/**
 * Class Session
 * @package Library
 */
class Session{

	const FLASH_KEY = 'flash_message';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->start();
    }

    /**
     *
     */
    public function start()
	{
		session_start();
	}

    /**
     *
     */
    public function destroy()
	{
		session_destroy();
	}

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
	{
		return isset($_SESSION[$key]);
	}

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function get($key, $default = null)
	{
		if ($this->has($key)) {
			return $_SESSION[$key];
		}
		return $default;
	}

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
	{
		$_SESSION[$key] = $value;
        return $this;
	}

    /**
     * @param $key
     */
    public function remove($key)
	{
		if ($this->has($key)) {
			unset($_SESSION[$key]);
		}
	}

    /**
     *
     */
    public function clear()
	{
	    unset($_SESSION);
    }

    /**
     * @param $message
     * @return $this
     */
    public function setFlash($message)
	{
		$this->set(self::FLASH_KEY, $message);
        return $this;
	}

    /**
     * @return null
     */
    public function getFlash()
	{
		$message = $this->get(self::FLASH_KEY);
        $this->remove(self::FLASH_KEY);
		return $message;
	}
}
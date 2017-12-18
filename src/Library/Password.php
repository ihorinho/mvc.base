<?php

namespace Library;

/**
 * Class Password
 * @package Library
 */
class Password{

    const SALT = 'Hala, Madrid!';

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $hashedPassword;

    /**
     * Password constructor.
     * @param $word
     * @param null $salt
     */
    public function __construct($word, $salt = null)
    {
        $salt = is_null($salt) ? md5(self::SALT) : md5($salt);
        $this->salt = $salt;
        $this->hashedPassword = md5($salt . $word);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->hashedPassword;
    }
}
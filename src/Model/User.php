<?php

namespace Model;

/**
 * Class User
 * @package Model
 */
class User{

    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $email;

    /**
     * @var
     */
    private $password;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email){
		$this->email = $email;

		return $this;
	}

    /**
     * @return mixed
     */
    public function getEmail(){

		return $this->email;
	}

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password){
		$this->password = $password;

		return $this;
	}

    /**
     * @return mixed
     */
    public function getPassword(){

		return $this->password;
	}
}
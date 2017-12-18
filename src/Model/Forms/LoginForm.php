<?php
namespace Model\Forms;
use Library\Request;

/**
 * Class LoginForm
 * @package Model\Forms
 */
class LoginForm{
    /**
     * @var null|string
     */
    private $email = '';
    /**
     * @var null|string
     */
    private $password = '';
    /**
     * @var null|string
     */
    private $remember = '';

    /**
     * LoginForm constructor.
     * @param Request $request
     */
    public function __construct(Request $request){
		$this->email = $request->post('email');
		$this->password = $request->post('password');
		$this->remember = $request->post('remember');
	}

    /**
     * @return bool
     */
    public function isValid(){
		return $this->email !== '' &&
				$this->password !== '';
	}

    /**
     * @return null|string
     */
    public function getEmail(){
		return $this->email;
	}

    /**
     * @return null|string
     */
    public function getPassword(){
		return $this->password;
	}

    /**
     * @return bool
     */
    public function rememberUser(){
		return $this->remember == 'on';
	}
}
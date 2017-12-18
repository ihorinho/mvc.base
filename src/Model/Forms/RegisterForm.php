<?php
namespace Model\Forms;
use Library\Request;

class RegisterForm{
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
    private $repeatedPassword = '';
    /**
     * @var null|string
     */
    private $remember = '';
    /**
     * @var null
     */
    private $phrase;

    /**
     * RegisterForm constructor.
     * @param Request $request
     */
    public function __construct(Request $request){
		$this->email = $request->post('email');
		$this->password = $request->post('password');
		$this->remember = $request->post('remember');
        $this->repeatedPassword = $request->post('repeatedPassword');
        $this->phrase = $request->post('phrase');
    }

    /**
     * @return bool
     */
    public function isValid(){
		return $this->email !== '' &&
				$this->password !== '' &&
				$this->repeatedPassword !== '' &&
                $this->phrase !== '';;
	}

    /**
     * @return null|string
     */
    public function getRepeatedPassword()
    {
        return $this->repeatedPassword;
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
     * @return null
     */
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * @return bool
     */
    public function rememberUser(){
		return $this->remember == 'on';
	}

    /**
     * @return bool
     */
    public function passwordsMatch(){
        return $this->password === $this->repeatedPassword;
    }
}
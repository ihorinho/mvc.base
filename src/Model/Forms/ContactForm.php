<?php
namespace Model\Forms;
use Library\Request;

/**
 * Class ContactForm
 * @package Model\Forms
 */
class ContactForm{
    /**
     * @var null|string
     */
    private $username = '';
    /**
     * @var null|string
     */
    private $email = '';
    /**
     * @var null|string
     */
    private $message = '';
    /**
     * @var null
     */
    private $phrase;

    /**
     * ContactForm constructor.
     * @param Request $request
     */
    public function __construct(Request $request){
		$this->username = $request->post('username');
		$this->email = $request->post('email');
		$this->message = $request->post('message');
		$this->phrase = $request->post('phrase');
	}

    /**
     * @return bool
     */
    public function isValid(){
		return $this->username !== '' &&
				$this->email !== ''&&
				$this->message !== '' &&
				$this->phrase !== '';
	}

    /**
     * @return null|string
     */
    public function getUsername(){
		return $this->username;
	}

    /**
     * @return null|string
     */
    public function getEmail(){
		return $this->email;
	}

    /**
     * @return null
     */
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * @return null|string
     */
    public function getMessage(){
		return $this->message;
	}
}
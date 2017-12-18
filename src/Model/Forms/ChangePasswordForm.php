<?php
namespace Model\Forms;
use Library\Request;

/**
 * Class ChangePasswordForm
 * @package Model\Forms
 */
class ChangePasswordForm{
    /**
     * @var string
     */
    private $old_passw = '';
    /**
     * @var string
     */
    private $new_passw = '';
    /**
     * @var string
     */
    private $repeated_new_passw = '';

    /**
     * ChangePasswordForm constructor.
     * @param Request $request
     */
    public function __construct(Request $request){
		$this->old_passw = clearString($request->post('old_passw'));
		$this->new_passw = clearString($request->post('new_passw'));
		$this->repeated_new_passw = clearString($request->post('repeated_new_passw'));
	}

    /**
     * @return bool
     */
    public function isValid(){
		return $this->old_passw !== '' &&
				$this->new_passw !== '' &&
                $this->repeated_new_passw !== '';
	}

    /**
     * @return null|string
     */
    public function getOldPassw()
    {
        return $this->old_passw;
    }

    /**
     * @return null|string
     */
    public function getRepeatedNewPassw()
    {
        return $this->repeated_new_passw;
    }

    /**
     * @return bool
     */
    public function matchPasswords(){
        return $this->new_passw === $this->repeated_new_passw;
    }

    /**
     * @return string
     */
    public function getNewPassw()
    {
        return $this->new_passw;
    }
}
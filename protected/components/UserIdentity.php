<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 * вв
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	private $_login;
	public function authenticate()
	{
		$record = Users::model()->findByAttributes(array('mail' => $this->username));
		if ($record === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if ($record->password !== md5($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_id = $record->id;
			$this->_login=$record->mail;
			if($record->privileges==100){
				$session = new CHttpSession;
				$session->open();

				if (isset($session['id'])) {

				}
				$session['id'] = $record->id;
				$session['login'] = $record->mail;
				$session['privileges'] = $record->privileges;
				$session->close();
			}
			$this->setState('name', $record->name);
			{
				$this->errorCode = self::ERROR_NONE;
			}
		}
		return !$this->errorCode;

	}

	public function getId()
	{
		return $this->_id;
	}
}
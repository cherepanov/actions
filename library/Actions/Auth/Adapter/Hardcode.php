<?php
require_once '/Zend/Auth/Adapter/Interface.php';

class Actions_Auth_Adapter_Hardcode implements Zend_Auth_Adapter_Interface
{
	protected $_username;
	protected $_password;

	protected $_users = array(
			'vip' => array('password' => 'vip', 'type' => 'vip')
		,	'user' => array('password' => 'user', 'type' => 'user')
	);

	public function setUsername($username)
	{
		$this->_username = $username;
	}

	public function setPassword($password)
	{
		$this->_password = $password;
	}

	public function authenticate()
	{
		$result = new Zend_Auth_Result(Zend_Auth_Result::FAILURE, array());
		$user = $this->_users[$this->_username];

		if (!empty($this->_username) && !empty($this->_password)
			&& !empty($user)
			&& $user['password'] == $this->_password
		) {
			$result = new Zend_Auth_Result(
				Zend_Auth_Result::SUCCESS,
				array(
					'username' => $this->_username,
					'type' => $this->_users[$this->_username]['type']
				)
			);
		}

		return $result;
	}

}
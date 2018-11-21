<?php
class UserInfo
{
	var $m_id;
	var $m_userName;
	var $m_status;

	function __construct($id, $name, $status)
	{
		$this->m_id = $id;
		$this->m_userName = $name;
		$this->m_status = $status;
	}

	function getID()
	{
		return $this->m_id;
	}

	function getUserName()
	{
		return $this->m_userName;
	}

	function getStatus()
	{
		return $this->m_status;
	}
}

?>
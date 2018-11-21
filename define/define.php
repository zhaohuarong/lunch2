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

class LunchInfo
{
	var $mID;
	var $mUserID;
	var $mTime;
	var $mStatus;

	function __construct($id, $userID, $time, $status)
	{
		$this->mID = $id;
		$this->mUserID = $userID;
		$this->mTime = $time;
		$this->mStatus = $status;
	}

	function getUserID()
	{
		return $this->mUserID;
	}

	function getTime()
	{
		return $this->mTime;
	}

	function getStatus()
	{
		return $this->mStatus;
	}
}

?>
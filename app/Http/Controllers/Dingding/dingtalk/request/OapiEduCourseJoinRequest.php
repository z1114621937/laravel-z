<?php
/**
 * dingtalk API: dingtalk.oapi.edu.course.join request
 * 
 * @author auto create
 * @since 1.0, 2021.05.27
 */
class OapiEduCourseJoinRequest
{
	/** 
	 * 需要加入的课程编码
	 **/
	private $courseCode;
	
	/** 
	 * 用户角色
	 **/
	private $joinRole;
	
	/** 
	 * 操作用户id
	 **/
	private $opUserId;
	
	private $apiParas = array();
	
	public function setCourseCode($courseCode)
	{
		$this->courseCode = $courseCode;
		$this->apiParas["course_code"] = $courseCode;
	}

	public function getCourseCode()
	{
		return $this->courseCode;
	}

	public function setJoinRole($joinRole)
	{
		$this->joinRole = $joinRole;
		$this->apiParas["join_role"] = $joinRole;
	}

	public function getJoinRole()
	{
		return $this->joinRole;
	}

	public function setOpUserId($opUserId)
	{
		$this->opUserId = $opUserId;
		$this->apiParas["op_user_id"] = $opUserId;
	}

	public function getOpUserId()
	{
		return $this->opUserId;
	}

	public function getApiMethodName()
	{
		return "dingtalk.oapi.edu.course.join";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->courseCode,"courseCode");
		RequestCheckUtil::checkNotNull($this->opUserId,"opUserId");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}

<?php
/**
 * dingtalk API: dingtalk.oapi.smartdevice.atmachine.get_by_userid request
 * 
 * @author auto create
 * @since 1.0, 2021.04.09
 */
class OapiSmartdeviceAtmachineGetByUseridRequest
{
	/** 
	 * 查询智能考勤机列表参数模型
	 **/
	private $param;
	
	private $apiParas = array();
	
	public function setParam($param)
	{
		$this->param = $param;
		$this->apiParas["param"] = $param;
	}

	public function getParam()
	{
		return $this->param;
	}

	public function getApiMethodName()
	{
		return "dingtalk.oapi.smartdevice.atmachine.get_by_userid";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}

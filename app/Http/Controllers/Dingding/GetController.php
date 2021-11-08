<?php

namespace App\Http\Controllers\Dingding;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetForm;
use App\Http\Requests\GetPhoto;
use App\Models\Users;
use DingTalkClient;
use DingTalkConstant;
use OapiGettokenRequest;
use OapiUserGetuserinfoRequest;
use OapiV2UserGetRequest;

class GetController extends Controller
{
    /** *获取企业token
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function gettoken()
    {
        include "TopSdk.php";
        date_default_timezone_set('Asia/Shanghai');

        $c = new DingTalkClient(DingTalkConstant::$CALL_TYPE_OAPI, DingTalkConstant::$METHOD_GET, DingTalkConstant::$FORMAT_JSON);
        $req = new OapiGettokenRequest;
        $req->setAppkey("dingahnwgw4qfxtxfoje");
        $req->setAppsecret("iJtRg3GnTtjg4V66JrqohtQe5hBWKucXhabD6DfQ48RGgB72QH9AXM9gTzqjGeBt");
        $resp = $c->execute($req, 'iJtRg3GnTtjg4V66JrqohtQe5hBWKucXhabD6DfQ48RGgB72QH9AXM9gTzqjGeBt', "https://oapi.dingtalk.com/gettoken");
        $token = $resp->access_token;
        return $token;
    }
    /** *获取基本信息
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getform(GetForm $request)
    {
        $code = $request['code'];  //从前端获取个人用户的code
        $token = GetController::gettoken();
        date_default_timezone_set('Asia/Shanghai');
        $c = new DingTalkClient(DingTalkConstant::$CALL_TYPE_OAPI, DingTalkConstant::$METHOD_GET, DingTalkConstant::$FORMAT_JSON);
        $req = new OapiUserGetuserinfoRequest;
        $req->setCode($code);
        $resp = $c->execute($req, $token, "https://oapi.dingtalk.com/user/getuserinfo");
        // $errcode = $resp->errcode;
        $sys_level = $resp->sys_level;
        $is_sys = $resp->is_sys;
        $name = $resp->name;
        // $errmsg = $resp->errmsg;
        $deviceId = $resp->deviceId;
        $userid = $resp->userid;
        $res=Users::createin($sys_level,$is_sys,$name,$userid,$deviceId);
      /*  $date['errcode'] = $errcode;
        $date['sys_level'] = $sys_level;
        $date['is_sys'] = $is_sys;
        $date['name'] = $name;
        $date['errmsg'] = $errmsg;
        $date['deviceId'] = $deviceId;
        $date['userid'] = $userid;*/
        return $res?   //判断
            json_success("获取成功",$res,200):
            json_fail("获取失败",null,100);
    }
    /** *获取用户头像
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function gettutu(GetPhoto $request)
    {
        $userid = $request['userid'];   //获取用户的userid
        $token= GetController::gettoken();
        date_default_timezone_set('Asia/Shanghai');
        $c = new DingTalkClient(DingTalkConstant::$CALL_TYPE_OAPI, DingTalkConstant::$METHOD_POST, DingTalkConstant::$FORMAT_JSON);
        $req = new OapiV2UserGetRequest;
        $req->setUserid($userid);
        $resp = $c->execute($req,$token, "https://oapi.dingtalk.com/topapi/v2/user/get");
        $user_chart=$resp->result->avatar;
        $res=Users::createchart($userid,$user_chart);
        return $user_chart?   //判断
            json_success("获取成功",$user_chart,200):
            json_fail("获取失败",null,100);
    }

}

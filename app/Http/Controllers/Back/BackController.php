<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alllook;
use App\Http\Requests\Allstatelook;
use App\Http\Requests\Commentdelete;
use App\Http\Requests\Commentdeletedongtai;
use App\Http\Requests\Commentnamedongtai;
use App\Http\Requests\Helpdelete;
use App\Http\Requests\Helpdeleteqiuzhu;
use App\Http\Requests\Helpnameqiuzhu;
use App\Http\Requests\Looktime;
use App\Http\Requests\Userclose;
use App\Http\Requests\Useropen;
use App\Models\Comment;
use App\Models\Help;
use App\Models\Users;
use Illuminate\Http\Request;

class BackController extends Controller
{
    /** * 查看user信息数据
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function user_look()
    {
        $res=Users::wzh_userlook();
        return $res?   //判断
            json_success("查询成功",$res,200):
            json_fail("查询失败",null,100);
    }
    /** *根据userid查看个人发布数据
     * @param Alllook $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function all_look(Alllook $request)
    {
        $userid=$request['userid'];
        $comment=Comment::wzh_commentlook($userid);
        $help=Help::wzh_helplook($userid);
        $date['comment']=$comment;
        $date['help']=$help;

        return $date?   //判断
            json_success("查询成功",$date,200):
            json_fail("查询失败",null,100);
    }
    /** *  根据user时间删除发布的动态数据
     * @param Commentdelete $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function comment_delete(Commentdelete $request)
    {
        $userid=$request['userid'];
        $created_at=$request['created_at'];
        $res=Comment::wzh_commentdelete($userid,$created_at);
        return $res?   //判断
            json_success("删除成功",$res,200):
            json_fail("删除失败",null,100);
    }
    /** *  根据user时间与state删除发布求助的数据
     * @param Helpdelete $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function help_delete(Helpdelete $request)
    {
        $userid=$request['userid'];
        $created_at=$request['created_at'];
        $res=Help::wzh_helpdelete($userid,$created_at);
        return $res?   //判断
            json_success("删除成功",$res,200):
            json_fail("删除失败",null,100);
    }


    /** * 根据数据类型和时间查看个人发布数据
     * @param Allstatelook $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function all_statelook(Allstatelook $request)
    {
        $userid=$request['userid'];
        $state=$request['state'];
        $created_at=$request['created_at'];
        if($state=='动态')
            $res=Comment::wzh_commentstatelook($userid,$created_at);
        if($state=='求助')
            $res=Help::wzh_helpstatelook($userid,$created_at);
        return $res?   //判断
            json_success("查询成功",$res,200):
            json_fail("查询失败",null,100);
    }
    /** * 禁用user
     * @param Userclose $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function user_close(Userclose $request)
    {
        $userid=$request['userid'];
        $res=Users::wzh_userclose($userid);
        return $res?   //判断
            json_success("禁用成功",$res,200):
            json_fail("禁用失败",null,100);
    }
    /** * 开放user
     * @param Useropen $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function user_open(Useropen $request)
    {
        $userid=$request['userid'];
        $res=Users::wzh_useropen($userid);
        return $res?   //判断
            json_success("开放成功",$res,200):
            json_fail("开放失败",null,100);
    }

    /** * 根据userid和state查询时间
     * @param Looktime $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function look_time(Looktime $request)
    {
        $userid=$request['userid'];
        $state=$request['state'];
        if($state=='动态')
            $res=comment::wzh_commenttime($userid,$state);
        if($state=='求助')
            $res=Help::wzh_helptime($userid,$state);
        return $res?   //判断
            json_success("查看成功",$res,200):
            json_fail("查看失败",null,100);
    }
    /** * 查询所有动态
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function comment_alldongtai()
    {
        $res=comment::wzh_commentalldongtai();
        return $res?   //判断
            json_success("查看成功",$res,200):
            json_fail("查看失败",null,100);
    }
    /** * 查询所有求助
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function help_allqiuzhu()
    {
        $res=Help::wzh_helpallqiuzhu();
        return $res?   //判断
            json_success("查看成功",$res,200):
            json_fail("查看失败",null,100);
    }
    /** * 查询所有根据姓名查询动态
     * @param Commentnamedongtai $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function comment_namedongtai(Commentnamedongtai $request)
    {
        $comment_name=$request['comment_name'];
        $res=comment::wzh_commentnamedongtai($comment_name);
        return $res?   //判断
            json_success("查看成功",$res,200):
            json_fail("查看失败",null,100);
    }
    /** * 查询所有根据姓名查询求助
     * @param Helpnameqiuzhu $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function help_nameqiuzhu(Helpnameqiuzhu $request)
    {
        $help_name=$request['help_name'];
        $res=Help::wzh_helpnameqiuzhu($help_name);
        return $res?   //判断
            json_success("查看成功",$res,200):
            json_fail("查看失败",null,100);
    }








    /** *  根据user时间与删除发布的动态
     * @param Commentdeletedongtai $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function comment_deletedongtai(Commentdeletedongtai $request)
    {
        $userid=$request['userid'];
        $created_at=$request['created_at'];
        $res=Comment::wzh_commentdeletedongtai($userid,$created_at);
        return $res?   //判断
            json_success("删除成功",$res,200):
            json_fail("删除失败",null,100);
    }
    /** *  根据user时间与删除发布的动态
     * @param Helpdeleteqiuzhu $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function help_deleteqiuzhu(Helpdeleteqiuzhu $request)
    {
        $userid=$request['userid'];
        $created_at=$request['created_at'];
        $res=Help::wzh_helpdeleteqiuzhu($userid,$created_at);
        return $res?   //判断  
            json_success("删除成功",$res,200):
            json_fail("删除失败",null,100);
    }
}

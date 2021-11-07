<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\front\CommentModel;
use App\Models\front\HelpSendModel;
use App\Models\front\PraiseModel;
use App\Models\front\ReplyModel;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    /***
     * 动态展示
     * @param Request $request
     *
     */
    public function dynamicAll(){
        $res=CommentModel::yjx_allDynamic();
        return $res ?
            json_success('展示成功!', $res, 200) :
            json_fail('展示失败!', null, 100);
    }
    /***
     * 别人的朋友圈
     * @param Request $request
     * userid
     */
    public function otherDynamic(Request $request){
        $res['res1']=CommentModel::yjx_otherDynamic($request); //动态内容
        return $res ?
            json_success('查看成功!', $res, 200) :
            json_fail('查看成功!', null, 100);
    }
    /***
     * 返回朋友圈的评论
     * comment_userid  user_article
     */
    public function commentReply(Request $request){
        $res=CommentModel::yjx_otherComments($request);//动态评论
        return $res ?
            json_success('查看成功!', $res, 200) :
            json_fail('查看成功!', null, 100);
    }
    /***
     * 发布朋友圈
     * @param Request $request
     *comment_name  comment_article userid
     * comment_state comment_chart
     */
    public function sendDynamic(Request $request){
        $res=CommentModel::yjx_sendDynamic($request);
        return $res ?
            json_success('发表成功!', null, 200) :
            json_fail('发表失败!', null, 100);
    }
    /***
     *评论和 别人评论后的评论
     * @param Request $request
     *comment_name comment_article userid comment_userid user_name comment_chart user_article
     */
    public function  commentReplys(Request $request){
        $res=CommentModel::yjx_commentReply($request);
        return $res ?
            json_success('评论成功!', null, 200) :
            json_fail('评论成功!', null, 100);
    }
    /***
     *  点赞
     * @param Request $request
     * praise_name comment_id
     */
    public function  praise(Request $request){
        $res=PraiseModel::yjx_praise($request);
        return $res ?
            json_success('点赞成功!', null, 200) :
            json_fail('点赞失败!', null, 100);
    }

    /***
     * 得到是谁点赞
     * @param Request $request
     *comment_id
     */
    public function  getPraise(Request $request){
        $res=PraiseModel::yjx_otherPraise($request);
        return $res ?
            json_success('查找成功!', $res, 200) :
            json_fail('查找失败!', null, 100);
    }

    /***
     *  发表求助
     * @param Request $request
     * help_name help_article  userid  help_chart
     */
    public function  helpSend(Request $request){
        $res = HelpSendModel::yjx_helpSend($request);
        return $res ?
            json_success('发表成功!', null, 200) :
            json_fail('发表失败!', null, 100);
    }
    /***
     *  求助评论
     * @param Request $request
     * help_name help_article  userid  help_userid help_chart user_article
     */
    public function  helpReply(Request $request){
        $res = HelpSendModel::yjx_helpReply($request);
        return $res ?
            json_success('评论成功!', null, 200) :
            json_fail('评论成功!', null, 100);
    }

    /***
     * 回复求助回复的回复
     * @param Request $request
     * help_name help_article  userid  help_userid user_name help_chart user_article
     */
    public function  helpReplys(Request $request){
        $res = HelpSendModel::yjx_helpReplys($request);
        return $res ?
            json_success('评论成功!', null, 200) :
            json_fail('评论成功!', null, 100);
    }





}

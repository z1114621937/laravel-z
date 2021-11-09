<?php

namespace App\Models\front;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    //
    protected $table = "comment";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    /***
     * 发朋友圈的动态
     * @param $request
     * comment_name  comment_article userid
     * comment_state comment_chart
     */
    public static function yjx_sendDynamic($request){
        try {
            $res=self::create([
                'comment_name'  => $request['comment_name'],
                'comment_article' => $request['comment_article'],
                'userid'  => $request['userid'],
                'state' => 1,
                'comment_state' => $request['comment_state'],
                'comment_chart' => $request['comment_chart'],
            ]);
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 展示所有的朋友圈
     *
     */
   public static function yjx_allDynamic(){
       try {
           $res=self::select('id','comment_name','comment_article','userid','comment_state','comment_chart')
               ->where('state',1)
               ->get();
           return $res?
               $res :
               false;
       } catch (\Exception $e) {
           logError('搜索错误', [$e->getMessage()]);
           return false;
       }
   }
    /***
     * 返回某人朋友圈的内容
     * @param $request
     *  userid
     */
    public static function yjx_otherDynamic($request){
        try {
            $res=self::select('comment_article','comment_state','comment_chart')
                ->where('state',1)
                ->where('userid',$request['userid'])->get();
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * 返回朋友圈的评论
     * @param $request
     * comment_userid  user_article
     */
    public static function yjx_otherComments($request){
        try {
            $res=self::select('comment_name','comment_article','userid','user_name')
                ->where('comment_userid',$request['comment_userid'])
                ->where('user_article',$request['user_article'])
                ->where('state',2)
                ->get();
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 别人评论后的评论
     *comment_name comment_article userid comment_userid user_name comment_chart user_article
     */
    public static function yjx_commentReply($request){
        try {
            $res=self::create([
                'comment_name'  => $request['comment_name'],
                'comment_article' => $request['comment_article'],
                'userid'=>$request['userid'],
                'comment_userid'  => $request['comment_userid'],
                'state' => 2,
                'user_name'=>$request['user_name'],
                'comment_chart' => $request['comment_chart'],
                'user_article' => $request['user_article'],
            ]);
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
}

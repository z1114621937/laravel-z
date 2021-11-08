<?php

namespace App\Models\front;

use Illuminate\Database\Eloquent\Model;

class HelpSendModel extends Model
{
    //
    protected $table = "help";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];


 //  * help_name help_article  userid  help_chart
    public static function yjx_helpSend($request)
    {
        try {
            $res=self::create([
                'help_name' => $request['help_name'],
                'help_article' => $request['help_article'],
                'userid' => $request['userid'],
                'state' => 1,
                'help_chart' => $request['help_chart'],
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
     *  求助回复
     * help_name help_article  userid  help_userid  help_chart user_article
     */
    public static function yjx_helpReply($request)
    {
        try {
            $res=self::create([
                'help_name' => $request['help_name'],
                'help_article' => $request['help_article'],
                'userid' => $request['userid'],
                'help_userid' => $request['help_userid'],
                'state' => 2,
                'help_chart' => $request['help_chart'],
                'user_article' => $request['user_article'], //求助内容

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
     *  求助回复的回复
     * help_name help_article  userid  help_userid user_name  help_chart user_article
     */
    public static function yjx_helpReplys($request)
    {
        try {
            $res=self::create([
                'help_name' => $request['help_name'],
                'help_article' => $request['help_article'],
                'userid' => $request['userid'],
                'help_userid' => $request['help_userid'],
                'user_name' => $request['user_name'],
                'state' => 2,
                'help_chart' => $request['help_chart'],
                'user_article' => $request['user_article'], //求助内容
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

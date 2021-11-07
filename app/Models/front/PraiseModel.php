<?php

namespace App\Models\front;

use Illuminate\Database\Eloquent\Model;

class PraiseModel extends Model
{
    //
    protected $table = "praise";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    /***
     *  点赞
     * comment_id praise_name
     */
    public  static function yjx_praise($request){
        try {
            $res=self::create([
                'comment_id' => $request['comment_id'],
                'praise_name' => $request['praise_name'],
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
     * 返回朋友圈的点赞
     * @param $request
     */
    public static function yjx_otherPraise($request){
        try {
            $res=self::select('praise_name')
                ->where('comment_id',$request['comment_id'])->get();
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }


}

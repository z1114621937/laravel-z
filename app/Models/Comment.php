<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comment";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /**  根据user查看个人发布数据
     */
    public static function wzh_commentlook($userid){
        try {
            $data=self::where('userid','=',$userid)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据user时间与state删除发布的数据
     */
    public static function wzh_commentdelete($userid,$created_at){
        try {
            $data=self::where('userid','=',$userid)->where('created_at','=',$created_at)->delete();
            return $data;
        }
        catch (\Exception $e){
            logError('删除失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据数据类型和时间查看个人发布数据
     */
    public static function wzh_commentstatelook($userid,$created_at){
        try {
            $data=self::where('userid','=',$userid)->where('created_at','=',$created_at)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据userid和state查询时间
     */
    public static function wzh_commenttime($userid,$state){
        try {
            $data=self::select('created_at')->where('userid','=',$userid)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据查询所有动态
     */
    public static function wzh_commentalldongtai(){
        try {
            $data=self::get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据查询所有求助
     */
    public static function wzh_commentallqiuzhu(){
        try {
            $data=self::where('state','=',2)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据姓名查询动态
     */
    public static function wzh_commentnamedongtai($comment_name){
        try {
            $data=self::where('comment_name','=',$comment_name)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据姓名查询求助
     */
    public static function wzh_commentnameqiuzhu($comment_name){
        try {
            $data=self::where('state','=',2)->where('comment_name','=',$comment_name)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据user时间与删除发布的动态
     */
    public static function wzh_commentdeletedongtai($userid,$created_at){
        try {
            $data=self::where('userid','=',$userid)->where('created_at','=',$created_at)->delete();
            return $data;
        }
        catch (\Exception $e){
            logError('删除失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据user时间与删除发布的动态
     */
    public static function wzh_commentdeleteqiuzhu($userid,$created_at){
        try {
            $data=self::where('userid','=',$userid)->where('state','=',2)->where('created_at','=',$created_at)->delete();
            return $data;
        }
        catch (\Exception $e){
            logError('删除失败',[$e->getMessage()]);
            return false;
        }
    }
}

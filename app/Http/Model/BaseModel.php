<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/18 0018
 * Time: 上午 11:57
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public $timestamps = false;

    public static function batchAdd($data)
    {
        return self::insert($data);
    }

    public static function add(array $data)
    {
        return self::insertGetId($data);
    }

    /**
     * @param array $where
     * @param int $page
     * @param int $limit
     * @param string $order_by
     * @param string $sort
     * @param array $columns
     * @return array
     */
    public static function findListWhere(array $where = [],$page = 1,$limit = 30,$order_by = 'id',$sort = 'ASC',$columns = ['*'])
    {
        $page-=$page;
        $start = $page * $limit;
        $data = self::where($where)->offset($start)->limit($limit)->orderBy($order_by, $sort)->select($columns)->get();
        if($data){
            return $data->toArray();
        }

        return [];
    }

    public static function getAllWhere(array $where = [],$order_by = 'id',$sort = 'ASC',$columns = ['*'])
    {
        $data = self::where($where)->orderBy($order_by, $sort)->select($columns)->get();
        if($data){
            return $data->toArray();
        }

        return [];
    }

    /**
     * @param array $where
     * @param array $columns
     * @return array
     */
    public static function getInfoWhere(array $where = [],$columns = ['*'])
    {
        $data = self::where($where)->select($columns)->first();
        if($data){
            return $data->toArray();
        }

        return [];
    }

    /**
     * @param array $data
     * @param array $where
     * @return mixed
     */
    public static function upInfoWhere(array $data,array $where = [])
    {
        return self::where($where)->update($data);
    }

    public static function upInfoInWhere(array $data,array $where = [],$flied = '')
    {
        return self::whereIn($flied,$where)->update($data);
    }

    public static function delInfoWhere(array $where)
    {
        return self::where($where)->delete();
    }


}
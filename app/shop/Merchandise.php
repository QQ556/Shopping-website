<?php
namespace App\shop;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    //資料表 名稱
    protected $table = 'merchandise';
    //主鍵名稱
    protected $primarykey ='id';

    protected $fillable = [
        'id',
        'status',
        'user_id',
        'name',
        'name_en',
        'introduction',
        'introduction_en',
        'photo',
        'price',
        'remain_count'
    ];
    public function User()
    {   
        return $this->hasOne('app\User','id','user_id');
    }
}

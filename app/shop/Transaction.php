<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //資料表名稱
    protected $table = 'transaction';
 
    //主見名稱
    protected $primarykey = 'id';
    
    //可以大量變動欄位
    protected $fillable = [
        'id',
        'user_id',
        'merchandise_id',
        'price',
        'buy_count',
        'total_price',
    ];

    public function Merchandise()
    {
        return $this->hasOne('App\shop\Merchandise','id','merchandise_id');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    //資料表名稱
    protected $table = 'Merchandise';
    //主見名稱
    protected $primarykey = 'id';

    //可以大量變動欄位
    protected $fillable = [
        "id",
        "status",
        "name",
        "name_en",
        "introduction",
        "introduction_en",
        "photo",
        "price",
        "remain_count",
    ];
}

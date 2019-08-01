<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shop\Merchandise;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Merchandise_date = [

            "status"            => "c",    //建立中
            "name"                => '',
            "name_en"           => '',
            "introduction"      => '',
            "introduction_en"   => '',
            "photo"                => 'null',
            "price"                => '0',
            'remain_count'      => '0'
        ];
        $Merchandise = Merchandise::create($Merchandise_date);

        //重導商品編輯頁
        return redirect('/merchandise/' . $Merchandise->id . '/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($merchandise_id)
    {
        //撈取資料
        $Merchandise = Merchandise::findOrFail($merchandise_id);

        if (!is_null($Merchandise->photo)) {
            //設定商品照片網址
            $Merchandise->photo = url($Merchandise->photo);
        }
        $binding = [
            'title' => '編輯商品',
            'Merchandise' => $Merchandise,
        ];
        return view('merchandise.edit', $binding);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shop\Merchandise;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\DB;
use Validator;
use Image;
use PHPUnit\Runner\Exception;
use Illuminate\Support\Facades\Log;
use Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listPage()
    {
        $user_id = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        //每頁資料量
        $row_per_page = 10;
        //撈取商品頁資料
        $TransactionPaginate = Transaction::where('user_id',$user_id)
        ->OrderBy('created_at','desc')
        ->with('Merchandise')
        ->paginate($row_per_page);
        
        //設定商品圖片網址
        foreach($TransactionPaginate as &$Transaction){
            if(!is_null($Transaction->Merchandise->photo)){
                //設定商品照片網址
                $Transaction->Merchandise->photo = url($Transaction->Merchandise->photo);
            }
        }
        

        $binding =[
            'title'=>'交易紀錄',
            'TransactionPaginate' => $TransactionPaginate,
        ];
        return view('transaction.listUserTransaction',$binding);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
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

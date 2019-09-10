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

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    //(後台)商品單檢視
    public function manageListPage()
    {
        //每頁資料量
        $row_per_page = 10;
        //撈取商品分頁資料
        $MerchandisePage = Merchandise::OrderBy('created_at', 'desc')->paginate($row_per_page);

        //設定商品圖片網址
        foreach ($MerchandisePage as &$Merchandise) {
            if (!is_null($Merchandise->photo)) {
                //設定商品照片網址
                $Merchandise->photo = url($Merchandise->photo);
            }
        }
        $binding = [
            'title' => '管理商品',
            'MerchandisePage' => $MerchandisePage,
        ];

        return view('Merchandise.itemPage', $binding);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Merchandise_date = [
            "status"            => "C",    //建立中
            "name"                => '',
            "name_en"           => '',
            "introduction"      => '',
            "introduction_en"   => '',
            "photo"                => NULL,
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
    //(客用)商品列表檢視
    public function listMerchandise()
    {
        //每頁資料量
        $row_per_page = 12;
        //撈取分頁資料
        $MerchandisePaginate = Merchandise::Orderby('updated_at', 'desc')
            ->where('status', 'C') //可販售
            ->paginate($row_per_page);

        //設定商品圖片網址
        foreach ($MerchandisePaginate as &$Merchandise) {
            if (!is_null($Merchandise->photo)) {
                //設定商品圖片網址
                $Merchandise->photo = url($Merchandise->photo);
            }
        }
        $binding = [
            'title' => '商品列表',
            'MerchandisePaginate' => $MerchandisePaginate,
        ];
        return view('merchandise.listMerchandise', $binding);
    }

    //(客用)商品單品檢視
    public function itemMerchandise($merchandise_id)
    {

        //撈取商品資料
        $Merchandise = Merchandise::findOrFail($merchandise_id);

        if (!is_null($Merchandise->photo)) {
            //設定照片路徑
            $Merchandise->photo = url($Merchandise->photo);
        }
        $binding = [
            'title' => '商品頁',
            'Merchandise' => $Merchandise,
        ];
        return view('merchandise.itemMerchandise', $binding);
    }

    // 測試中
    // 測試中
    // 測試中

    //商品購買
    public function itemMerchandiseBuy($merchandise_id)
    {
        //接收輸入資料
        $input = request()->all();

        //驗證規則
        $rules = [
            //商品購買數量
            'buy_count' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
        //驗證資料
        $validator = validator::make($input, $rules);

        if ($validator->fails()) {
            //資料驗證錯誤
            return redirect('/merchandise/' . $merchandise_id)
                ->withErrors($validator)
                ->withInput();
        }

        try {

            //取得登入會員資料
            $user_id = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
            $User = User::findOrFail($user_id);

            //交易開始
            DB::beginTransaction();

            //取得商品資料
            $Merchandise = Merchandise::findOrFail($merchandise_id);

            //購買數量
            $buy_count = $input['buy_count'];


            //購買後數量
            $remain_count_after_buy = $Merchandise->remain_count - $buy_count;
            //購買完後負數 代表不足夠賣給客戶
            if ($remain_count_after_buy < 0) {
                throw new Exception('商品數量不足，無法購買');
            }
            //紀錄購買後的剩餘數量
            $Merchandise->remain_count = $remain_count_after_buy;
            $Merchandise->save();

            //交易處理這邊輸入
            //交易處理這邊輸入
            //交易處理這邊輸入

            //總金額
            $total_price = $buy_count * $Merchandise->price;

            $transaction_data = [
                'user_id' => $User->id,
                'merchandise_id' => $Merchandise->id,
                'price' => $Merchandise->price,
                'buy_count' => $buy_count,
                'total_price' => $total_price,
            ];
            //建立交易資料
            Transaction::create($transaction_data);
            // 交易結束
            DB::commit();

            //回傳購物成功訊息
            $message = [
                'msg' => [
                    '購買成功'
                ],
            ];
            return redirect('/merchandise/' . $Merchandise->id)
                ->withErrors($message);
            //若失敗
        } catch (\Exception $exception) {
            //恢復原先交易狀態
            DB::rollBack();
            //回傳錯誤訊息
            $error_message = [
                'msg' => [
                    $exception->getMessage(),
                ],
            ];
            return redirect()
                ->back()
                ->withError($error_message)
                ->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // (後台)商品編輯頁
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

    // (後台)商品刪除
    public function delete($merchandise_id)
    {
        //撈資料
        $Merchandise = Merchandise::findOrFail($merchandise_id);
        $Merchandise->delete();
         //重導編輯頁
         return redirect('/merchandise/manage');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($merchandise_id)
    {
        //撈資料
        $Merchandise = Merchandise::findOrFail($merchandise_id);
        //接收資料
        $input = request()->all();

        //驗證規則
        $rules = [
            //產品狀態 (create,sell)
            'status' => [
                'required',
                'in:C,S'
            ],
            //產品名稱
            'name' => [
                'required',
                'max:80'
            ],
            //產品英文名稱
            'name_en' => [
                'required',
                'max:80'
            ],
            //產品介紹
            'introduction' => [
                'required',
                'max:2000'
            ],
            //產品英文介紹
            'introduction_en' => [
                'required',
                'max:2000'
            ],
            //產品照片
            'photo' => [
                'file',
                'image',
                'max:10240' //10mb
            ],
            //產品價格
            'price' => [
                'required',
                'integer',
                'min:0',
            ],
            //商品剩餘數量
            'remain_count' => [
                'required',
                'integer',
                'min:0'
            ],
        ];

        //驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            //資料錯誤
            return redirect('/merchandise/' . $Merchandise->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        //有上傳圖片
        if (isset($input['photo'])) {
            //圖片
            $photo = $input['photo'];
            //檔案副檔名
            $file_extension = $photo->getClientOriginalExtension();
            //產生自訂隨機檔案名稱
            $file_name = uniqid() . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = 'images/merchandise/' . $file_name;
            // 檔案存放public下的相對目錄
            $file_path = public_path($file_relative_path);
            //裁切圖片
            $image = Image::make($photo)->fit(450, 300)->save($file_path);
            //設定圖片檔案相對位置
            $input['photo'] = $file_relative_path;
        }
        $Merchandise->update($input);

        //重導編輯頁
        return redirect('/merchandise/' . $Merchandise->id . '/edit');
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

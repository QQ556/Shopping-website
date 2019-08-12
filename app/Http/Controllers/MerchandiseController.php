<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shop\Merchandise;
use Validator;
use Image;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        
    }
    
    //商品單檢視
    public function manageListPage()
    { 
        //每頁資料量
        $row_per_page = 10;
        //撈取商品分頁資料
        $MerchandisePage = Merchandise::OrderBy('created_at','desc')->paginate($row_per_page);

        //設定商品圖片網址
        foreach($MerchandisePage as &$Merchandise){
            if(!is_null($Merchandise->photo)){
                //設定商品照片網址
                $Merchandise->photo = url($Merchandise->photo);
            }
        }
        $binding = [
            'title' => '管理商品',
            'MerchandisePage'=>$MerchandisePage,
        ];

        return view('Merchandise.itemPage',$binding);
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
    //商品清單檢視(遊客可看)
    public function guest_itemPage()
    {
        //每頁資料量
        $row_per_page = 10;
        //撈取分頁資料
        $MerchandisePaginate = Merchandise::Orderby('updated_at','desc')
        ->where('status','C')//可販售
        ->paginate($row_per_page);
        
        //設定商品圖片網址
        foreach($MerchandisePaginate as &$Merchandise){
            if(!is_null($Merchandise->photo)){
                //設定商品圖片網址
                $Merchandise->photo = url($Merchandise->photo);
            }
        }
        $binding = [
            'title'=>'商品列表',
            'MerchandisePaginate'=>$MerchandisePaginate,
        ];
        return view('merchandise.guest_itemPage','$binding');
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
    public function update($merchandise_id)
    {
        //撈資料
        $Merchandise = Merchandise::findOrFail($merchandise_id);
        //接收資料
        $input = request()->all();

        //驗證規則
        $rules = [
            //產品狀態 (create,sell)
            'status'=>[
                'required',
                'in:C,S'
            ],
            //產品名稱
            'name'=>[
                'required',
                'max:80'
            ],
            //產品英文名稱
            'name_en'=>[
                'required',
                'max:80'
            ],
            //產品介紹
            'introduction'=>[
                'required',
                'max:2000'
            ],
            //產品英文介紹
            'introduction_en'=>[
                'required',
                'max:2000'
            ],
            //產品照片
            'photo'=>[
                'file',
                'image',
                'max:10240'//10mb
            ],
            //產品價格
            'price'=>[
                'required',
                'integer',
                'min:0',
            ],
            //商品剩餘數量
            'remain_count'=>[
                'required',
                'integer',
                'min:0'
            ],
        ];

        //驗證資料
        $validator = Validator::make($input,$rules);

        if($validator->fails()){
            //資料錯誤
            return redirect('/merchandise/'.$Merchandise->id . '/edit')
            ->withErrors($validator)
            ->withInput();
        }

        //有上傳圖片
        if(isset($input['photo'])){
            //圖片
            $photo = $input['photo'];
            //檔案副檔名
            $file_extension =$photo->getClientOriginalExtension();
            //產生自訂隨機檔案名稱
            $file_name = uniqid(). '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = 'images/merchandise/' . $file_name;
            // 檔案存放public下的相對目錄
            $file_path = public_path($file_relative_path);
            //裁切圖片
            $image = Image::make($photo)->fit(450,300) -> save($file_path);
            //設定圖片檔案相對位置
            $input['photo'] = $file_relative_path;
        }
        $Merchandise->update($input);

        //重導編輯頁
        return redirect('/merchandise/'.$Merchandise->id.'/edit');
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

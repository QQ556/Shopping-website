<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Validator;
use auth;
use Illuminate\Support\Facades\Log;
use App\shop\Merchandise;
use Illuminate\Support\Facades\DB;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        $data = \Cart::getContent();
        foreach ($data as &$dataitem) {
            $id = $dataitem->id;
            $Merchandise = Merchandise::where('id', $id)->first();
            //設定商品圖片網址
            if (!is_null($Merchandise->photo)) {
                $Merchandise->photo = url($Merchandise->photo);
            }
        }
        Log::debug($Merchandise->photo);
        return view('cart.cart', [
            'Merchandise' => $Merchandise
        ]);
    }
    public function add(Request $res)
    {
        $add = \Cart::add([
            'id' => $res->id,
            'name' => $res->name,
            'price' => $res->price,
            'quantity' => $res->quantity
        ]);
        if ($add) {
            return view('cart.cart', [
                'data' => \Cart::getcontent()
            ]);
        }
    }

    public function emptyCart()
    {
        $userId = Auth::id(); // get this from session or wherever it came from
        Cart::clear();
        Log::debug($userId);
    }

    public function remove()
    {
        cart::remove(3);
        return redirect('/cart');
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\User;
use App\shop\Merchandise;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Input::get('query');
        $Merchandise = Merchandise::where('name', 'LIKE', '%' . $query . '%')->get();
        $Merchandise_countNum = count($Merchandise);
        $MerchandisePaginate = Merchandise::where('name', 'LIKE', '%' . $query . '%')->paginate(24);
        Log::debug($Merchandise_countNum);
        // Log::debug($Merchandise);
        if (isset($query)) {
            Session::put('keyword', $query);
            Session::put('countNum', $Merchandise_countNum);
        }
        if (count($Merchandise) > 0)
            return view('search',compact('MerchandisePaginate', 'query'));
        else return view('search')->withMessage('找不到商品');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function price_up()
    {
        $query = Input::get('query');
        $MerchandisePaginate = Merchandise::where('name', 'LIKE', '%' . $query . '%')->orderBy('price', 'ASC')->paginate(24);
        if (count($MerchandisePaginate) > 0)
            return view('search',compact('MerchandisePaginate', 'query'));
        else return view('search')->withMessage('找不到商品');
    }

    public function price_down()
    {
        $query = Input::get('query');
        $MerchandisePaginate = Merchandise::where('name', 'LIKE', '%' . $query . '%')->orderBy('price', 'DESC')->paginate(24);
        if (count($MerchandisePaginate) > 0)
            return view('search',compact('MerchandisePaginate', 'query'));
        else return view('search')->withMessage('找不到商品');
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

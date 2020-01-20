@include('layouts.app')
@section('content')

{{-- 商品頁開始 --}}
<div class="container mt-4">
    <div class="row justify-content-between">
        <div class="btn-group-lg mb-2" role="group" aria-label="Basic example">
            {{-- <a class="btn btn-secondary" href="http://laravel.shop.com/bestsell">銷售量</a> --}}
            <button id="pricebtn_search" class="btn btn-secondary material-icons">價格排序</button>
        </div>
        @isset($MerchandisePaginate)
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> 搜尋「<em>{{session()->get('keyword')}}</em>」結果,共有{{session()->get('countNum')}}項結果</li>
                </ol>
            </nav>
        </div>

        @include ('layouts.merchandiseArea')

        @endisset
        {{-- 商品頁結束 --}}
    </div>
</div>
{{-- 如果沒有商品 --}}
@empty ($MerchandisePaginate)
<div class="container">
    <div class="row">
        <div class="col">
            <h1></h1>
        </div>
        <div class="col">
            <h1>找不到商品</h1>
        </div>
        <div class="col"><span></span></div>
    </div>
    @endempty
</div>

{{-- 商品頁結束 --}}
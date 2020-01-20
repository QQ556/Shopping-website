@extends('layouts.app')
@section('content')
@section('title',$title)

{{-- 錯誤訊息 --}}
@include('components.vaildationErrorMessage')

{{-- 輪播圖開始 --}}
<div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active lazyload">
                <img src="/assets/Carousel/food.jpg" class="d-block w-100">
            </div>
            <div class="carousel-item lazyload">
                <img src="/assets/Carousel/food2.jpg" class="d-block w-100">
            </div>
            <div class="carousel-item lazyload">
                <img src="/assets/Carousel/food3.jpg" class="d-block w-100">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">上一張</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">下一張</span>
        </a>
    </div>
</div>
{{-- 輪播圖結束 --}}


{{-- 商品區開始 --}}
<div class="container mt-4">
    <div class="row">
        <div class="btn-group-lg mb-2" role="group" aria-label="Basic example">
            {{-- <a class="btn btn-secondary" href="http://laravel.shop.com/bestsell">銷售量</a> --}}
            <button id="pricebtn" class="btn btn-secondary material-icons">價格排序</button>
        </div>
        @include ('layouts.merchandiseArea')
        {{-- 商品區結束 --}}
    </div>
</div>
@endsection
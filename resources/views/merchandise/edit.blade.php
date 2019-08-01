@extends('layouts.app');
@section('content')
@section('title',$title)
<div class="container">
    <h1>{{$title}}</h1>
</div>



{{-- 錯誤訊息 --}}
@include('components.vaildationErrorMessage')
<div class="container">
    <form action="/merchandise/{{$Merchandise->id}}" method='post' enctype="multipart/form-data">
        {{-- 方法欄位 --}}
        {{method_field('PUT')}}
        <div class="form-group">
            商品狀態:
            <select name="status">

                <option value="C" @if (old('status',$Merchandise->status)=='C')selected @endif>
                    建立中
                </option>
                <option value="S" @if (old('status',$Merchandise->status)=='S')selected @endif>
                    販售中
                </option>
            </select>
        </div>

        <div class="form-group">
            商品名稱:
            <input class="form-control form-control-lg" type="text" type="text" name="name" placeholder="商品名稱"
                value="{{ old('name',$Merchandise->name) }}">
        </div>

        <div class="form-group">
            商品英文名稱
            <input class="form-control form-control-lg" type="text" type="text" name="name_en" placeholder="商品英文名稱"
                value="{{ old('name_en',$Merchandise->name_en) }}">
        </div>

        <div class="form-group">
            商品介紹
            <input class="form-control form-control-lg" type="text" type="text" name="introduction" placeholder="商品介紹"
                value="{{ old('introduction',$Merchandise->introduction)}}">
        </div>

        <div class="form-group">
            商品英文介紹
            <input class="form-control form-control-lg" type="text" type="text" name="introduction_en"
                placeholder="商品英文介紹" value="{{ old('introduction_en',$Merchandise->introduction_en)}}">
        </div>

        <div class="form-group">
            商品照片
            <input class="form-control form-control-lg" type="file" name="photo" placeholder="商品照片">
            <img src={{ $Merchandise->photo = $Merchandise->photo ??'/assets/images/default-merchandise.png' }} />
        </div>



        <div class="form-group">
            商品價格
            <input class="form-control form-control-lg" type="text" type="text" name="price" placeholder="商品價格"
                value="{{ old('price',$Merchandise->introduction_en)}}">
        </div>

        <div class="form-group">
            商品剩餘數量
            <input class="form-control form-control-lg" type="text" type="text" name="price" placeholder="商品剩餘數量"
                value="{{ old('price',$Merchandise->introduction_en)}}">
        </div>

        <button type="submit" class="btn btn-danger">更新產品資訊</button>
        {{-- CSRF --}}
        @csrf
</div>
</form>
</div>
@endsection
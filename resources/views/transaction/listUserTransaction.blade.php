@extends('layouts.app')
@section('content')
@section('title',$title)
<div class="container">
    <h1>{{$title}}</h1>
</div>



{{-- 錯誤訊息 --}}
@include('components.vaildationErrorMessage')
<div class="container">
    <table class="table">
        <tr>
            <td>商品名稱</td>
            <td>圖片</td>
            <td>單價</td>
            <td>數量</td>
            <td>總金額</td>
            <td>購買時間</td>
        </tr>
        @foreach ($TransactionPaginate as $Transaction)
        <tr>
            <td>
            <a href="/merchandise/{{$Transaction->Merchandise->id}}">{{$Transaction->Merchandise->name}}</a>
            </td>
            <td>
                <a href="/merchandise/{{$Transaction->Merchandise->id}}">
                    <img src="{{$Transaction->Merchandise->photo = $Transaction->Merchandise->photo ??'/assets/images/default-merchandise.png'}}" alt="">
                    </a>
            </td>
            <td>{{$Transaction->price}}</td>
            <td>{{$Transaction->buy_count}}</td>
            <td>{{$Transaction->total_price}}</td>
            <td>{{$Transaction->created_at}}</td>
        </tr>
        @endforeach
    </table>
    {{-- 分頁按鈕 --}}
    {{ $TransactionPaginate->links()}}
</div>
</form>
</div>
@endsection
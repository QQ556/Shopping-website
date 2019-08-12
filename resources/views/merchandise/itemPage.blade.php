@extends('layouts.app');
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
            <th>編號</th>
            <th>名稱</th>
            <th>圖片</th>
            <th>狀態</th>
            <th>價格</th>
            <th>剩餘數量</th>
            <th>編輯</th>
        </tr>
        @foreach ($MerchandisePage as $Merchandise)
        <tr>
            <td>{{ $Merchandise->id }}</td>
            <td>{{ $Merchandise->name }}</td>
            {{-- 商品圖片 --}}
            <td><img src="{{ $Merchandise->photo = $Merchandise->photo ??'/assets/images/default-merchandise.png'}}"
                    alt=""></td>
            <td>
                @if ($Merchandise->status =='C')
                建立中
                @else
                可販售
                @endif
            </td>
            <td>{{$Merchandise->price}}</td>
            <td>{{$Merchandise->remain_count}}</td>
            <td>
                <a href="/merchandise/{{ $Merchandise->id}}/edit">編輯</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $MerchandisePage->links()}}
</div>
</form>
</div>
@endsection
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
            <th>名稱</th>
            <td>{{$Merchandise->name}}</td>
        </tr>
        <tr>
            <th>照片</th>
            <td>
                <img class="Merchandise_pic" src="{{$Merchandise->photo = $Merchandise->photo ??'/assets/images/default-merchandise.png'}}">
            </td>
        </tr>
        <tr>
            <th>價格</th>
            <td>
                {{$Merchandise->price}}
            </td>
        </tr>
        <tr>
            <th>剩餘數量</th>
            <td>
                {{$Merchandise->remain_count}}
            </td>
        </tr>
        <tr>
            <th>介紹</th>
            <td>
                {{$Merchandise->introduction}}
            </td>
        </tr>
        <td colsapn="2">
            <form action="/merchandise/{{$Merchandise->id}}/buy" method="POST">
                購買數量
                <select name="buy_count" id="">
                    @for($count = 0;$count <= $Merchandise->remain_count;$count++)
                        <option value="{{$count}}">
                            {{$count}}
                        </option>
                    @endfor
                </select>
                <button type="submit">
                    購買
                </button>
                @csrf
            </form>
        </td>
    </table>
</div>
</form>
</div>
@endsection
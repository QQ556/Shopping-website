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
            <th style="width:20%">名稱</th>
            <td>{{$Merchandise->name}}</td>
        </tr>
        <tr>
            <th>照片</th>
            <td>
                <img class="Merchandise_pic"
                    src="{{$Merchandise->photo = $Merchandise->photo ??'/assets/images/default-merchandise.png'}}">
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

    </table>
    <table>
        <table class="table">
            <tr>
                <td>
                    @auth
                    <div>
                        <form action="/merchandise/{{$Merchandise->id}}/buy" method="POST">
                            <select name="buy_count" id="">
                                @for($count = 0;$count <= $Merchandise->remain_count;$count++)
                                    <option value="{{$count}}">
                                        {{$count}}
                                    </option>
                                    @endfor
                            </select>

                            <button class="btn btn-outline-danger" type="submit">
                                直接購買
                            </button>
                            @csrf
                        </form>
                        </span>
                        @endauth
                        @guest
                        <form>
                            購買數量
                            <select name="buy_count" id="">
                                @for($count = 0;$count <= $Merchandise->remain_count;$count++)
                                    <option value="{{$count}}">
                                        {{$count}}
                                    </option>
                                    @endfor
                            </select>
                            <a type="button" class="btn btn-outline-danger" href={{url('login')}}>
                                請先登入帳號
                            </a>
                        </form>
                        @endguest</td>
                <td>
                    {{-- Cart start --}}
                    <select id="Cart_count">
                        @for($count = 0;$count <= $Merchandise->remain_count;$count++)
                            <option value="{{$count}}">
                                {{$count}}
                            </option>
                            @endfor
                    </select>
                    <button　type="button" class='btn btn-outline-info' onclick='addCart({{$Merchandise->id}})'>加入購物車</button>
                    {{-- Cart End --}}
                </td>
            </tr>
        </table>

    </table>
</div>

@endsection
<script>
    let addCart = function (id) {
        let result = confirm('你要加入購物車嗎?');
        if(result){
            //取得 "username" 欄位值
            let Cart_count = $('#Cart_count').val();
            let actionUrl = 'http://laravel.shop.com/add';
            $.post(actionUrl,{id:id,name:"0",price:"0",quantity:Cart_count}).done(function(){
                location.reload();
            });
        }
    }
</script>
{{-- @foreach ($Cart as $Cartitem)
id:{{ $Cartitem->id }}<br>
name:{{ $Cartitem->name }}<br>
price:{{ $Cartitem->price }}<br>
quantity:{{ $Cartitem->quantity }}<br>
Merchandise_id:{{ $Cartitem->merchandise->id }}<br>
@endforeach --}}
@include('layouts.app')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="row">
                @foreach ($Cart as $Cartitem)
                <div class="col-xl-3 col-6 col-sm-4 col-md-3 mb-4 px-1">
                    <div class=" text-center h-100">
                        <a href="/merchandise/{{$Cartitem->id}}">
                            <img src="/assets/images/loading.png"
                                data-src="{{ $Cartitem->merchandise->photo = $Cartitem->merchandise->photo ??'/assets/images/default-merchandise.png'}}"
                                class="card-img-top lazy" alt="...">
                        </a>
                        <div class="Merchandise_name">{{ $Cartitem->merchandise->name }}
                            @if ($Cartitem->name === "")
                            暫無商品名稱
                            @endif
                        </div>
                        <div class="">
                            <p class="text-danger">{{$Cartitem->price}}</p>
                            <p>數量{{$Cartitem->quantity}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{-- 左側欄開始 --}}
        <div class="col-md-1 ">
            <div class="sticky-top float-right">
                <i id="question_answer" data-toggle="modal" data-target="#exampleModal"
                    class="btn btn-outline-dark material-icons md-48 ">question_answer</i>
                <form action="/search" class="form-inline my-2 my-lg-0" method="POST">
                    {{ csrf_field() }}
                    <i id="search" class="btn btn-outline-dark material-icons md-48 mt-4">search
                        <input id="search_input" type="search" class="close_find_btn" autocomplete="off"
                            autofocus="ture" placeholder="商品搜尋" name="query">
                    </i>
                </form>
            </div>
            <div class="p-2" id="formResults"></div>
        </div>
        {{-- 左側欄結束 --}}
    </div>
</div>
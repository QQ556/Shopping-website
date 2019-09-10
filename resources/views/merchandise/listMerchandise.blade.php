@extends('layouts.app')
@section('content')
@section('title',$title)
<div class="container">
    <h1>{{$title}}</h1>
</div>



{{-- 錯誤訊息 --}}
@include('components.vaildationErrorMessage')
<div class="container">
    <div class="container">
        <div class="row">
            {{-- 左側欄 --}}
            <div class="col-md-2"></div>
            {{-- 商品欄位 --}}
            <div class="col-md-10" >
                <div class="row" >
                    {{-- 單個商品頁 --}}
                    @foreach ($MerchandisePaginate as $Merchandise)
                    <div class="col-md-4 mb-4">
                        <div class="card  text-center h-100">
                            <a href="/merchandise/{{$Merchandise->id}}">
                                <img src="{{ $Merchandise->photo = $Merchandise->photo ??'/assets/images/default-merchandise.png'}}"
                                    class="card-img-top" alt="...">
                            </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $Merchandise->name }}
                                    @if ($Merchandise->name === "")
                                        暫無商品名稱
                                    @endif
                                    </h5>
                                </div>
                                <div class="card-footer ">
                                        <p class="text-danger">${{$Merchandise->price}}</p>
                                </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{ $MerchandisePaginate->links()}}
</div>
</form>
</div>
@endsection

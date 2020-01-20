{{-- 商品區開始 --}}

<div class="col-md-11">
    <div class="row">
        @foreach ($MerchandisePaginate as $Merchandise)
        <div class="col-xl-3 col-6 col-sm-4 col-md-3 mb-4 px-1">
            <div class=" text-center h-100">
                <a href="/merchandise/{{$Merchandise->id}}">
                    <img src="/assets/images/loading.png"
                        data-src="{{ $Merchandise->photo = $Merchandise->photo ??'/assets/images/default-merchandise.png'}}"
                        class="card-img-top lazy" alt="...">
                </a>
                <div class="Merchandise_name">{{ $Merchandise->name }}
                    @if ($Merchandise->name === "")
                    暫無商品名稱
                    @endif
                </div>
                <div class="">
                    <p class="text-danger">${{$Merchandise->price}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{-- 左側欄開始 --}}
<div class="col-md-1 ">
    <div class="sticky-top">
        <div class="float-right">
            <a href="{{url('/cart')}}" id="shopping_cart" class=" btn btn-outline-dark ">
                <span class='badge badge-warning' id='lblCartCount'>
                    @if (isset($cartTotalQuantity))
                    {{$cartTotalQuantity}}
                    @endif
                </span>
                <i id="shopping_cart" class="material-icons  md-48">shopping_cart</i>
            </a>
        </div>
        <div class="float-right">
            <form action="/search" class="form-inline my-2 my-lg-0" method="POST">
                {{ csrf_field() }}
                <i id="search" class="btn btn-outline-dark material-icons md-48 mt-4">search
                    <input id="search_input" type="search" class="close_find_btn" autocomplete="off" autofocus="ture"
                        placeholder="商品搜尋" name="query">
                </i>
            </form>
            <div class="p-2" id="formResults"></div>
        </div>

    </div>
</div>
{{-- 左側欄結束 --}}
</div>
</div>
<div class="d-flex justify-content-center">{{ $MerchandisePaginate->links()}}</div>
{{-- 商品區結束 --}}

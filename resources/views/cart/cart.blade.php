{{-- @foreach ($data as $dataitem)
id:{{ $dataitem->id }}<br>
name:{{ $dataitem->name }}<br>
price:{{ $dataitem->price }}<br>
quantity:{{ $dataitem->quantity }}<br>
@endforeach --}}

@foreach ($Merchandise as $dataitem)
名稱{{$dataitem->name}}
數量{{$dataitem->quantity}}
<div class="col-xl-3 col-6 col-sm-4 col-md-3 mb-4 px-1">
    <div class=" text-center h-100">
        <a href="/merchandise/{{$dataitem->id}}">
            <img src="/assets/images/loading.png"
                data-src="{{ $dataitem->photo = $dataitem->photo ??'/assets/images/default-merchandise.png'}}"
                class="card-img-top lazy" alt="...">
        </a>
        <div class="Merchandise_name">{{ $dataitem->name }}
            @if ($dataitem->name === "")
            暫無商品名稱
            @endif
        </div>
        <div class="">
            <p class="text-danger">{{$dataitem->price}}</p>
        </div>
    </div>
</div>

@endforeach
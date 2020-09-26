@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        年份
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button">2020</button>
                        <button class="dropdown-item" type="button">2019</button>
                        <button class="dropdown-item" type="button">2018</button>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        種類
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button">科幻</button>
                        <button class="dropdown-item" type="button">喜劇</button>
                        <button class="dropdown-item" type="button">動畫</button>
                    </div>
                </div>

                <div class="card-header">商品列表</div>


                <div class="card-body">
                    {{-- 以下顯示各個電影 --}}
                    <div class="card" style="width: 10rem;">
                        <img class="card-img-top" src="/fake_data/lion King picture.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ \Illuminate\Support\Str::limit("獅子王 (2019) (DVD)", 10, '...') }}</h5>
                            <p>價格 NTD: 500 </p>
                            <a href="#" class="btn btn-primary">View detail</a>
                            <button class="btn btn-success">直接購買</button>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
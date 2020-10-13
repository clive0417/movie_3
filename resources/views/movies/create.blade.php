<!--layouts. 的 . 代表資料夾-->
@extends('layouts.app')

@section('page_title')
<section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-uppercase text-white">新增商品</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ action('HomeController@index') }}">首頁</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ action('MovieController@index') }}">電影管理總表</a>
                            </li>
                            <li class="breadcrumb-item active">新增商品</li>
                        </ol>
                    </div>
                </div>
            </div>
</section>
@endsection

@section('content')
<div class="page-content">
    <div class="container">
        {{-- 是因為update 時要傳舊資料 --}}
    @include('movies.movie_create_form',['movie'=>$movie],['isCreate'=> $isCreate])

    </div>
</div>


@endsection
            
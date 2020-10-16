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
        {{-- 是因為update 時要傳舊資料區分才有isCreate --}}
        @include('movies.movie_create_form',['movie'=>$movie])
        <br>
        <form method="get" action="/movies/create/searchTMDBID">
            <label class="text-white lead">TMDBID搜尋</label>
            <br>
            <input type="text" name="searchTMDB" placeholder="請輸入電影名稱" >
            <button type="submit" class="btn btn-primary">送出</button>
        </form>
        @if (isset($_GET['searchTMDB'] ))
        {{-- 返回TMDB搜尋結果 --}}
        @foreach ($searchmovieArrays as $searchmovieArray)
        <label class="text-white lead">電影名稱:{{$searchmovieArray['title']}}</label>
        <br>
        <label class="text-white lead" >電影TMDBID:{{$searchmovieArray['id']}}</label>
        <br>
        <img src="https://image.tmdb.org/t/p/w300{{$searchmovieArray['poster_path']}}" alt="">
        <br>
            
        @endforeach
        @endif


    </div>
</div>


@endsection
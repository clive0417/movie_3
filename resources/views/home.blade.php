@extends('layouts.app')

@section('content')

<div class="col-md-10 mx-auto">


    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle test" type="button" id="dropdownMenu2" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            年分
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            @foreach ($years as $key=> $year)
            <a href="{{action('HomeController@index',['year'=> $year,'genre_id'=>$request->get('genre_id'), 'language_id'=>$request->get('language_id') ])}}"
                class="dropdown-item" type="button">{{$year}}</a>
            @endforeach
        </div>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle test" type="button" id="dropdownMenu2" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            語言
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            @foreach ($languages as $key=> $language)
            <a href="{{action('HomeController@index',['language_id'=> $language->id,'genre_id'=>$request->get('genre_id'), 'year'=> $request->get('year') ])}}"
                class="dropdown-item" type="button">{{$language->name}}</a>
            @endforeach
        </div>
    </div>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            種類[genres]
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            @foreach ($genres as $key=> $genre)
            <a href="{{action('HomeController@index',['genre_id'=> $genre->id,'language_id'=>$request->get('language_id'), 'year'=> $request->get('year') ])}}"
                class="dropdown-item" type="button">{{$genre->name}}</a>

            @endforeach
        </div>
    </div>




    <div class="card-header">
        <div class="left">商品列表</div>
        @if(isset($_GET['genre_id'] ))
        <button
            onclick="removegetgenre({{$_GET['genre_id']}})">種類-{{App\Genre::find($_GET['genre_id'])->name}}X</button>
        @endif

        @if(isset($_GET['language_id'] ))
        <button
            onclick="removegetlanguage({{$_GET['language_id']}})">語言-{{App\language::find($_GET['language_id'])->name}}X
        </button>
        @endif

        @if(isset($_GET['year'] ))
        <button onclick="removegetyear({{$_GET['year']}})">年份-{{$_GET['year']}}X</button>
        @endif
        @if(isset($_GET['year'])||isset($_GET['language_id'] )||isset($_GET['genre_id'] ))
        <a href="/home" class="btn btn-primary right_in_homepage_cardheader right">取消所有篩選</a>
        @endif
    </div>
</div>

<br>







<div class="col-md-10 mx-auto movie_zone">
    {{-- 以下顯示各個電影 --}}
    @foreach ($movies as $movie)
    <div class="movie_div" style="width:200x, height:350px;border:3px">

        <a href="{{action('MovieController@show',$movie->id)}}"><img class="movie_pic" src="{{$movie->posterUrl}}"
                width="160" height="240" alt="Card image cap"></a>

        <div class="movie_des" style="width:130px,">
            <h5 class="card-title">{{str_limit($movie->title,$limit = 15, $end = '...')}}</h5>
            <p>價格 NTD: {{$movie->price}} </p>

        </div>
    </div>
    @endforeach
</div>







@endsection
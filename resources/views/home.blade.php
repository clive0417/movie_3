@extends('layouts.app')

@section('content')

<div class="col-md-10 mx-auto">


    @guest
    <br>
    <br>
    <div class="alert alert-info " role="alert">
        測試帳號[管理者] shou@shou.com<br>
        測試密碼[管理者] shoushoushou<br>
        測試帳號[管理者] a@a<br>
        測試密碼[管理者] aaaaaaaa<br>
        或按註冊這側一個測試帳號<br>
      </div>

    @endguest
    <br>
    <br>
    <div class="card-header">
        <div class="left text-white"><h4 class="left text-white" >商品列表</h4></div>
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
        <a href="{{ action('HomeController@index') }}" class="btn btn-primary right_in_homepage_cardheader right">取消所有篩選</a>
        @endif
    </div>
    <br>
    <br>
    <div class="dropdown home_page_filter">
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
    <div class="dropdown home_page_filter">
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

    <div class="dropdown home_page_filter">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            分類
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            @foreach ($genres as $key=> $genre)
            <a href="{{action('HomeController@index',['genre_id'=> $genre->id,'language_id'=>$request->get('language_id'), 'year'=> $request->get('year') ])}}"
                class="dropdown-item" type="button">{{$genre->name}}</a>

            @endforeach
        </div>
    </div>

</div>

<br>
<br>







<div class="col-md-10 mx-auto movie_zone">
    {{-- 以下顯示各個電影 --}}
    @foreach ($movies as $movie)
    <div class="movie_div" style="width:200x, height:350px;border:3px">

        <a href="{{action('MovieController@show',$movie->id)}}"><img class="movie_pic" src="{{$movie->posterUrl}}"
                width="160" height="240"  alt="Card image cap"></a>

        <div class="movie_des" style="width:130px,">

            <h5 class="text-center text-white"><br>{{str_limit($movie->title,$limit = 15, $end = '...')}}</h5>
            <p  class="text-center text-white">價格 NTD: {{$movie->price}} </p>

        </div>
    </div>
    @endforeach
</div>








@endsection
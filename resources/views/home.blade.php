@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle test" type="button" id="dropdownMenu2"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    年分
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    @foreach ($years as $key=> $year)
                    @if(isset($_GET['genre_id'] )&& isset($_GET['language_id']))
                    <a href="{{action('HomeController@index',['year'=> $year,'genre_id'=>$_GET['genre_id'],'language_id'=>$_GET['language_id'] ])}}"
                        class="dropdown-item" type="button">{{$year}}</a>
                    @elseif(isset($_GET['genre_id'] ))
                    <a href="{{action('HomeController@index',['year'=> $year,'genre_id'=>$_GET['genre_id']])}}"
                        class="dropdown-item" type="button">{{$year}}</a>
                    @elseif(isset($_GET['language_id'] ))
                    <a href="{{action('HomeController@index',['year'=> $year,'language_id'=>$_GET['language_id'] ])}}"
                        class="dropdown-item" type="button">{{$year}}</a>
                    @else
                    <a href="{{action('HomeController@index',['year'=> $year])}}" class="dropdown-item"
                        type="button">{{$year}}</a>
                    @endif

                    @endforeach
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle test" type="button" id="dropdownMenu2"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    語言
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    @foreach ($languages as $key=> $language)
                    @if(isset($_GET['genre_id'])&& isset($_GET['year']) )
                    <a href="{{action('HomeController@index',['language_id'=> $language->id,'genre_id'=>$_GET['genre_id'],'year'=>$_GET['year'] ])}}"
                        class="dropdown-item" type="button">{{$language->name}}</a>
                    @elseif(isset($_GET['genre_id']))
                    <a href="{{action('HomeController@index',['language_id'=> $language->id,'genre_id'=>$_GET['genre_id'] ])}}"
                        class="dropdown-item" type="button">{{$language->name}}</a>

                    @elseif(isset($_GET['year']))
                    <a href="{{action('HomeController@index',['language_id'=> $language->id,'year'=>$_GET['year'] ])}}"
                        class="dropdown-item" type="button">{{$language->name}}</a>
                    @else
                    <a href="{{action('HomeController@index',['language_id'=> $language->id])}}" class="dropdown-item"
                        type="button">{{$language->name}}</a>
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    種類[genres]
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    @foreach ($genres as $key=> $genre)
                    @if(isset($_GET['language_id'])&& isset($_GET['year']))
                    <a href="{{action('HomeController@index',['genre_id'=> $genre->id,'language_id'=>$_GET['language_id'],'year'=>$_GET['year'] ])}}"
                        class="dropdown-item" type="button">{{$genre->name}}</a>
                    @elseif(isset($_GET['language_id']))
                    <a href="{{action('HomeController@index',['genre_id'=> $genre->id,'language_id'=>$_GET['language_id'] ])}}"
                        class="dropdown-item" type="button">{{$genre->name}}</a>
                    @elseif(isset($_GET['year']))
                    <a href="{{action('HomeController@index',['genre_id'=> $genre->id,'year'=>$_GET['year'] ])}}"
                        class="dropdown-item" type="button">{{$genre->name}}</a>
                    @else
                    <a href="{{action('HomeController@index',['genre_id'=> $genre->id])}}" class="dropdown-item"
                        type="button">{{$genre->name}}</a>
                    @endif
                    @endforeach
                </div>
            </div>


            <div class="card-header">
                <div class="left">商品列表</div>
                @if(isset($_GET['genre_id'] ))
                <button onclick="removegetgenre({{$_GET['genre_id']}})">種類-{{App\Genre::find($_GET['genre_id'])->name}}X</button>     
                @endif

                @if(isset($_GET['language_id'] ))
                <button onclick="removegetlanguage({{$_GET['language_id']}})">語言-{{App\language::find($_GET['language_id'])->name}}X </button>
                @endif

                @if(isset($_GET['year'] ))
                <button onclick="removegetyear({{$_GET['year']}})">年份-{{$_GET['year']}}X</button>
                @endif
                
                <a href="/home" class="btn btn-primary right_in_homepage_cardheader right">取消所有篩選</a>

            </div>


            <div class="movie_area">
                {{-- 以下顯示各個電影 --}}
                @foreach ($movies as $movie)
                <div class="card single_movie_card" style="width: 10rem;">

                    <img class="card-img-top" src="{{$movie->posterUrl}}" alt="Card image cap">

                    <div class="card-body">
                        <h5 class="card-title">{{$movie->title}}</h5>
                        <p>價格 NTD: {{$movie->price}} </p>
                        <a href="{{action('MovieController@show',$movie->id)}}" class="btn btn-primary">View detail</a>
                    </div>


                </div>
                @endforeach




            </div>

        </div>
    </div>
</div>
@endsection
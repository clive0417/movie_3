@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle test" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        年份 [暫時先以假資料]
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
                        種類[genres]
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        @foreach ($genres as $key=> $genre)
                        <a href="{{action('HomeController@indexWithGenre',$genre->id)}}" class="dropdown-item" type="button">{{$genre->name}}</a>
                        @endforeach
                    </div>
                </div>

                <div class="card-header">商品列表</div>


                <div class="movie_area">
                    {{-- 以下顯示各個電影 --}}
                    @foreach ($movies as $movie)
                    <div class="card single_movie_card" style="width: 10rem;">

                        <img class="card-img-top" src="{{$movie->posterUrl}}" alt="Card image cap">

                        <div class="card-body">
                            <h5 class="card-title">{{$movie->title}}</h5>
                            <p>價格 NTD: {{$movie->price}} </p>
                            <a href="{{action('HomeController@show',$movie->id)}}" class="btn btn-primary">View detail</a>
                        </div>                           
                        

                    </div>
                    @endforeach




                </div>

        </div>
    </div>
</div>
@endsection
<!--layouts. 的 . 代表資料夾-->
@extends('layouts.app')



@section('content')
<div class="page-content">
    <div class="container">
        {{-- 是因為view data 時要傳舊資料 --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $key => $error)
                <li>{{$error}}</li>


                @endforeach
            </ul>
        </div>
        @endif


        <!--csrf 塞 session token 去跨過csrf -->



        <div class="form-group">
            <label>Title</label>
            <p>{{$movie->title}}</p>
            <label>價格</label>
            <p>{{$movie->price}}</p>
            <label>上映日期</label>
            <p>{{$movie->releaseDate}}</p>
            <label>Overview</label>
            <p>{{$movie->overview}}</p>
            <label>語言</label>
            <p>{{$languagesString}}</p>
            <label>分類 </label>
            <p>{{$genresString}}</p>
            <br>
            <label>電影海報</label>
            <br>
            <img src="{{$movie->posterUrl}}" alt="電影海報空缺">




        </div>
        <div class="form-group">
            <form action="">
                @csrf
                <input type="hidden" name="movie_id" class="form-control" value="{{$movie->id}}">


                <label>購買數量</label>
                <select name="count" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <option selected>Choose...</option>
                    @for ($i = 1; $i < 10; $i++) 
                        <option value="{{$i}}">{{$i}}</option>

                    @endfor
                </select>
                <button type="submit" class="btn btn-primary">購買</button>
                <button type="button" class="btn btn-default" onclick="window.history.back()">cancel</button>

            </form>



        </div>
    </div>


    @endsection
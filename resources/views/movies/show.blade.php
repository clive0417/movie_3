<!--layouts. 的 . 代表資料夾-->
@extends('layouts.app')



@section('content')
<div class="page-content">
    <div class="container">
        {{-- 顯示錯誤訊息 --}}
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
        @if (!Auth::check())
        <div class="alert alert-danger">如需購買請先登入或註冊</div>
        @endif



        <div class="form-group">
            <div class="image-container">
                <img class="movie_show_image" src="{{$movie->posterUrl}}" alt="電影海報空缺">
                <label class="text-white lead" >電影名稱</label>
                <p class="text-white">{{$movie->title}}</p>
                <label class="text-white lead" >價格</label>
                <p class="text-white">{{$movie->price}}</p>
                <label class="text-white lead" >上映日期</label>
                <p class="text-white">{{$movie->releaseDate}}</p>
                <br class="clearn">
                <label class="text-white lead" >電影名稱</label>
                <p class="text-white">{{$movie->title}}</p>
                <label class="text-white lead" >價格</label>
                <p class="text-white">{{$movie->price}}</p>
                <label class="text-white lead" >上映日期</label>
                <p class="text-white">{{$movie->releaseDate}}</p>
                <label class="text-white lead" >敘述</label>
                <p class="text-white">{{$movie->overview}}</p>
                <label class="text-white lead" >語言</label>
                <p class="text-white">{{$languagesString}}</p>
                <label class="text-white lead" >分類 </label>
                <p class="text-white">{{$genresString}}</p>
                <br>
                <div class="form-group">
                    <form method="post" action="/shoppingitems">
                        @csrf
                        <input type="hidden" name="user_id" class="form-control" value="{{$user_id}}">
                        <input type="hidden" name="movie_id" class="form-control" value="{{$movie->id}}">
                        <input type="hidden" name="price" class="form-control" value="{{$movie->price}}">
                        <input type="hidden" name="title" class="form-control" value="{{$movie->title}}">
                        <input type="hidden" name="posterUrl" class="form-control" value="{{$movie->posterUrl}}">
        
                        @if (Auth::check())
                        <label  class="text-white">購買數量</label>
        
                        <input type="number" name="count" min="1" max="99" required >
                        <br>
        
                        <button type="submit" class="btn btn-primary">加入購物車</button>
                        @endif
                        <button type="button" class="btn btn-default" onclick="window.history.back()">取消</button>
        
                    </form>
        
        
        
                </div>

            </div>


        </div>

    </div>


    @endsection
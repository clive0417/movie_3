<!--layouts. 的 . 代表資料夾-->
@extends('layouts.app')

@section('page_title')
<section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <br>
                        <h4 class="text-uppercase text-white">電影管理總表</h4>
                        <br>
                        <br>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ action('HomeController@index') }}">首頁</a>
                            </li>

                            <li class="breadcrumb-item active">電影管理總表</li>
                        </ol>
                    </div>
                </div>
            </div>
</section>
@endsection

@section('content')
<section class="body-content ">

    <div class="page-content">
        <div class="container">
            <div class="toolbox">

            <a href="/movies/create" class="btn btn-primary">新增商品</a>
            </div>
            <br>
            <br>
            
            <ul class="list-group">
                @foreach ($movies as $key=>$movie)
                    <li  class="list-group-item clearfix">
                        <div class="float-left">
                            <div class="name">{{$movie->title}}</div>

                          

                        </div>


                        <span class="float-right">
                            <a href="{{ action('MovieController@edit',$movie->id) }}" class="btn btn-primary">編輯</a>
                            <button class="btn btn-danger" onclick="deleteMovie({{$movie->id}})">刪除</button>
                        </span>
                    </li>    
                @endforeach

            </ul>
        </div>

    </div>


</section>
@endsection

@section('script')

<script>



</script>

@endsection
            
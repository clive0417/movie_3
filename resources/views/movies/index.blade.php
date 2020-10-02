<!--layouts. 的 . 代表資料夾-->
@extends('layouts.app')

@section('page_title')
<section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-uppercase">Movie Admin table</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ action('HomeController@index') }}">Home</a>
                            </li>

                            <li class="breadcrumb-item active">Movie Admin table</li>
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
            <a href="/movies/create" class="btn btn-primary">create Movie</a>
            </div>
            
            <ul class="list-group">
                @foreach ($movies as $key=>$movie)
                    <li  class="list-group-item clearfix">
                        <div class="float-left">
                            <div class="name">{{$movie->title}}</div>

                          

                        </div>


                        <span class="float-right">
                            <a href="{{ action('MovieController@edit',$movie->id) }}" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" onclick="deleteMovie({{$movie->id}})">Delete</button>
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
            
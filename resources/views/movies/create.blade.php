<!--layouts. 的 . 代表資料夾-->
@extends('layouts.app')

@section('page_title')
<section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-uppercase">Create Movie</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ action('HomeController@index') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ action('MovieController@index') }}">Movie Admin table</a>
                            </li>
                            <li class="breadcrumb-item active">Create Movie</li>
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
            
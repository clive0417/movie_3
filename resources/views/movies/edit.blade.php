<!--layouts. 的 . 代表資料夾-->
@extends('layouts.app')

@section('page_title')
<section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-uppercase">Single Movie Detail info</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ action('HomeController@index') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ action('MovieController@index') }}">Movie Admin table</a>
                            </li>
                            <li class="breadcrumb-item active">Single Movie Detail info</li>
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
    @include('movies.movie_update_form',['movie'=>$movie,'isCreate'=> $isCreate,'genresString' =>$genresString, 'languagesString' => $languagesString])

    </div>
</div>


@endsection
            
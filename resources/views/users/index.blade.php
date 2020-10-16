@extends('layouts.app')

@section('page_title')
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-uppercase text-white">會員權限管理總表</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ action('HomeController@index') }}">首頁</a>
                    </li>

                    <li class="breadcrumb-item active">會員權限管理總表</li>
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

            <br>
            <br>

            <ul class="list-group">

                @foreach ($users as $key=>$user)
                <li class="list-group-item clearfix">
                    <div class="float-left">
                        <div class="name">id:{{$user->id}}<br>會員名稱:{{$user->name}}<br>e-mail:{{$user->email}}<br>
                            會員權限:@if($user->management===1)一般會員@elseif($user->management===2)一般管理者@elseif($user->management===3)root管理者  @endif
                        </div>

                    </div>

                    @if ($user->management!==3)
                    <span class="float-right"> 修改權限

                        <button class="btn btn-secondary"onclick="changeUserRightNormal({{$user->id}})">一般會員</button>
                        <button class="btn btn-primary"onclick="changeUserRightManager({{$user->id}})">一般管理者</button>



                    </span>
                    @endif
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
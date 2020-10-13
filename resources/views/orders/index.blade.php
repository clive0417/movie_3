<!--layouts. 的 . 代表資料夾-->
@extends('layouts.app')

@section('page_title')
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-uppercase text-white">訂單總表</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ action('HomeController@index') }}">首頁</a>
                    </li>

                    <li class="breadcrumb-item active">訂單總表</li>
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


            <ul class="list-group">

                @foreach ($orders as $key=>$order)
                <div class="order_info">訂購人:{{$order->user->name}}</div>
                <div class="order_info">訂單編號:{{$order->id}}</div>
                <div class="order_info">下單時間:{{$order->created_at}}</div>
                <div class="order_info">總金額:{{$order->fee}}</div>


                <table class="table_box" style="border:3px #cccccc solid;" cellpadding="10" border="1">

                    <thead>
                        <tr>

                            <th >電影名稱</th>
                            <th >數量</th>
                            <th >單價</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderitems as $key=>$orderitem)

                        <tr class="item">

                            <td class="table_row">{{App\Movie::withTrashed()->find($orderitem->movie_id)->title}}<br><img class="shopping_car_img"
                                    src={{App\Movie::withTrashed()->find($orderitem->movie_id)->posterUrl}}></td>
                            <td class="table_row">{{$orderitem->count}}</td>
                            <td class="table_row">{{$orderitem->price}}</td>
                        </tr>
                            


                        @endforeach
                        <td  class="table_row" rowspan="2"><button class="btn btn-danger"
                            onclick="deleteOrder({{$order->id}})">Delete</button></td>
                        </tr>


                    </tbody>
                </table>
                <br>
                <br>
                <br>

                @endforeach
                </table>

            </ul>
        </div>

    </div>


</section>
@endsection

@section('script')

<script>



</script>

@endsection
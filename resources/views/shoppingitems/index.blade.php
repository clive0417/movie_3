<!--layouts. 的 . 代表資料夾-->
@extends('layouts.app')

@section('page_title')
<section class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-uppercase">ShoppingCar table</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ action('HomeController@index') }}">Home</a>
                    </li>

                    <li class="breadcrumb-item active">ShoppingCar table</li>
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
            <!-- 購買清單 start -->
            <table class="table_box">
                <thead>
                    <tr>
                        <th >商品名稱</th>
                        <th >數量</th>
                        <th >單價</th>
                        <th >取消</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shoppingitems as $shoppingitem)
                        <tr class="item">
                            <td class="table_row" >{{$shoppingitem->movie->title}}<br><img class="shopping_car_img" src={{$shoppingitem->movie->posterUrl}}></td>
                            <td class="table_row">{{$shoppingitem->count}}</td> 
                            <td class="table_row">{{$shoppingitem->price}}</td>
                            <td class="table_row"><button class="btn btn-danger" onclick="deleteShoppingitem({{$shoppingitem->id}})">Delete</button></td>
                        </tr>
                        
                    @endforeach 
                </tbody>
            </table>
            <form action="" method="get">
                <input type="hidden" name="user_id" value={{$user_id}}>
                <input type="hidden" name="fee" value={{$fee}}>

            </form>
            <div>
                <h3 class="shoppingitem_total_fee">總計: NTD {{$fee}}</h3>

            </div>
            <br><br>


            <button type="button" class="shoppingitem_for_right btn btn-default" onclick="window.history.back()">cancel</button>
            <button type="submit" class="shoppingitem_for_right btn btn-primary">Submit</button>
            
        

        </div>

    </div>



    <!-- 購買清單 end -->



</section>
@endsection

@section('script')

<script>



</script>

@endsection
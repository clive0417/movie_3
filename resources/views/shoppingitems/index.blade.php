
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
            <table class="table_box table_shop_list">
                <thead>
                    <tr>
                        <th>商品名稱</th>
                        <th>數量</th>
                        <th>單價</th>
                        <th>取消</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shoppingitems as $shoppingitem)
                    <tr class="item">
                        <td class="table_row"><a href="/movies/{{App\Movie::withTrashed()->find($shoppingitem->movie_id)->id}}">{{App\Movie::withTrashed()->find($shoppingitem->movie_id)->title}}</a><br><a href="/movies/{{App\Movie::withTrashed()->find($shoppingitem->movie_id)->id}}">{{App\Movie::withTrashed()->find($shoppingitem->movie_id)->title}}"><img  class="shopping_car_img"
                            src={{App\Movie::withTrashed()->find($shoppingitem->movie_id)->posterUrl}} ></a></td>
                        <td><input class="shoppingitem_table_count" type="number" onblur="changecount({{$shoppingitem->id}},this.value)" name="count" value="{{$shoppingitem->count}}"></td>
                        <td class="table_row">{{App\Movie::withTrashed()->find($shoppingitem->movie_id)->price}}</td>
                        <td class="table_row"><button class="btn btn-danger"
                                onclick="deleteShoppingitem({{$shoppingitem->id}})">Delete</button></td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <form method="post" action="/orders">


                @csrf
                <p>地址</p>
                <input type="text" name="address"  placeholder="請輸入地址" required>
                <input type="hidden" name="user_id" value={{$user_id}}>
                <input type="hidden" name="fee" value={{$fee}}>

                 @foreach ($shoppingitems as $shoppingitem)
                    <input type="hidden" name="shoppingitemsId[]" value={{$shoppingitem->id}}>
                @endforeach

                
                <div>
                    <h3 class="shoppingitem_total_fee">總計: NTD {{$fee}}</h3>

                </div>
                <br>
                <br>

                <a class="shoppingitem_for_right btn btn-default" href="{{ action('HomeController@index') }}">繼續購物</a>
                <button type="submit" class="shoppingitem_for_right btn btn-primary">Submit</button>

            </form>

            <br><br>






        </div>

    </div>



    <!-- 購買清單 end -->



</section>
@endsection

@section('script')

<script>



</script>

@endsection
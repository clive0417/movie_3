<?php

namespace App\Http\Controllers;

use DB;
use App\Order;
use App\Orderitem;
use App\Movie;
use App\Genre;
use App\Language;
use App\Shoppingitem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();





        // Log::info("test2");
        
        return view('orders.index',['orders'=>$orders]);
    }

    public function show()
    {
        $id = Auth::id();
        $orders =Order::where('user_id',$id)->get();

        // Log::info($orders);
        // Log::info("test");
        
        return view('orders.show',['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $order = new Order;
        $order->fill($request->all());
        $order->save();
        $lastid=$order->id;
        $shoppingitems=Shoppingitem::all();
        $shoppingitemsId=$request['shoppingitemsId'];
        //Log::info($lastid);
        foreach ($shoppingitemsId as $key => $shoppingitemId) {

            $shoppingitem = Shoppingitem::where('id', $shoppingitemId)->get();
            DB::table('orderitems')->insert(['user_id' => $shoppingitem[0]->user_id,'order_id' => $lastid,
            'movie_id'=> $shoppingitem[0]->movie_id,'count' =>$shoppingitem[0]->count,'price'=>$shoppingitem[0]->price
              ,'title'=>$shoppingitem[0]->title,'posterUrl'=>$shoppingitem[0]->posterUrl
            //  ,'title'=> Movie::where('id',$shoppingitem[0]->movie_id)->title,'posterUrl'=> Movie::where('id',$shoppingitem[0]->movie_id)->posterUrl
            ]);
            DB::table('shoppingitems')->where('id',$shoppingitemId)->update(['done' => 1]);
            
            
        }







        
        //Log::info( $_POST);

        return redirect('/');

    }
    public function update(Request $request, Order $order)
    {
        // 電影table 填入資料
        Log::info($request);
         $order->fill($request->all());
         $order->save();




        return redirect('/orders');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();
    }


}

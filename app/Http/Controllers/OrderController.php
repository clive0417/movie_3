<?php

namespace App\Http\Controllers;

use DB;
use App\Order;
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
        $orders =Order::all();
        // Log::info($orders);
        // Log::info("test2");
        
        return view('orders.index',['orders'=>$orders]);
    }

    public function show()
    {
        $id = Auth::id();
        $orders =Order::where('user_id',$id)->get();
        // Log::info($orders);
        // Log::info("test");
        
        return view('orders.index',['orders'=>$orders]);
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
        $shoppingitemsId=$request['shoppingitemsId'];
        //Log::info($lastid);
        foreach ($shoppingitemsId as $key => $shoppingitemId) {
            # code...
            DB::table('shoppingitems')->where('id', $shoppingitemId)->update(['order_id' => $lastid]);
        }






        
        //Log::info( $_POST);

        return redirect('/home');

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

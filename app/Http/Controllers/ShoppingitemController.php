<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Genre;
use App\Language;
use App\Shoppingitem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShoppingitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $id = Auth::id();

        $shoppingitems = Shoppingitem::where('user_id',$id)->whereNull('order_id')->get();

        $fee=0;



        foreach ($shoppingitems as $key => $shoppingitem) {

            $fee=$fee+$shoppingitem['count']*$shoppingitem['price'];



            
            // Log::info($fee);

        }
        

            


        
        
        return view('shoppingitems.index',['shoppingitems'=>$shoppingitems,'user_id'=>$id,'fee'=>$fee]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shoppingitem = new Shoppingitem;
        $shoppingitem->fill($request->all());
        $shoppingitem->save();

        return redirect('/home');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shoppingitem  $shoppingitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoppingitem $shoppingitem)
    {

        $shoppingitem->delete();
    }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//[Route::method 網址位置, 對應Controller] 
// genre 的篩選功能 


Route::get('/home/{movie}', 'HomeController@show')->name('home');

Route::resource('movies','MovieController');
//動詞	  路徑	             行為	     路由名稱                                  
   //GET	 /movies   	          index	    movie  [總表]                                                   
    //GET	 /movies/create 	  create   	movie.create [Create 頁面]                
    //POST   /movies              store   	movie.store [存資料 / create DB 互動]
    //GET	 /movies/{id}         show	    movie.show [顯示單一產品頁面-->本次不需要]
    //GET	 /movies/{id}/edit	  edit	    movie.edit [edit 頁面]
    //PUT	 /movies/{id}	      update	movie.update [更新產品功能頁面]
    //DELETE /movies/{id}         destroy	movie.destroy [刪除]                        

Route::resource('shoppingitems','ShoppingitemController');

    //動詞	  路徑	             行為	     路由名稱                                  
   //GET	 /shoppingitems   	          index	    movie  [總表]                              //D                      
    //GET	 /shoppingitems/create 	  create   	movie.create [Create 頁面]                 //D 
    //POST   /shoppingitems              store   	movie.store [存資料 / create DB 互動]
    //GET	 /shoppingitems/{id}         show	    movie.show [顯示單一產品頁面-->本次不需要]
    //GET	 /shoppingitems/{id}/edit	  edit	    movie.edit [edit 頁面]
    //PUT	 /shoppingitems/{id}	      update	movie.update [更新產品功能頁面]
    //DELETE /shoppingitems/{id}         destroy	movie.destroy [刪除]   /

Route::resource('orders','OrderController');

    //動詞	  路徑	             行為	     路由名稱                                  
   //GET	 /order   	          index	    order  [總表]                              //D                      
    //GET	 /order/create 	     create   	order.create [Create 頁面]                 //D 
    //POST   /order              store   	order.store [存資料 / create DB 互動]
    //GET	 /order/{id}         show	    order.show [顯示單一產品頁面-->本次不需要]
    //GET	 /order/{id}/edit	  edit	    order.edit [edit 頁面]
    //PUT	 /order/{id}	      update	order.update [更新產品功能頁面]
    //DELETE /order/{id}         destroy	order.destroy [刪除]    
Route::resource('users','UserController');

    //動詞	  路徑	               行為	     路由名稱                                  
   //GET	 /user   	          index	    user  [總表]                              //D                      
    //PUT	 /user/{id} 	      update	user.update [更新產品功能頁面]   
Route::get('/searchTMDBID','MovieController@searchTMDBID'); 
Route::get('/search/{searchname}','MovieController@searchTMDBID2'); 

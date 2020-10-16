/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { replace } = require('lodash');
var newurl= "";



 
require('./bootstrap'); 

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    deleteMovie = function (id) {
        let result = confirm('Do you want to delete movie?');
        //console.log(result); 驗證result 帶入0,1 OK
        
        if (result) {
            let actionUrl ='/movies/'+id;//組合網址
            //console.log(actionurl);位置驗證OK
            //console.log(actionUrl);
            
            $.post(actionUrl,{_method:'delete'}).done(function() {
                console.log('test');
                location.href = '/movies';//重新整理頁面 
    
            });
    
        };
    
        
    };
    
    deleteShoppingitem = function (id) {
        let result = confirm('Do you want to delete this item?');
        //console.log(result); 驗證result 帶入0,1 OK
        
        if (result) {
            let actionUrl ='/shoppingitems/'+id;//組合網址
            //console.log(actionurl);位置驗證OK
            //console.log(actionUrl);
            
            $.post(actionUrl,{_method:'delete'}).done(function() {
                location.href = '/shoppingitems';//重新整理頁面 
    
            });
    
        };
    
        
    };
    
    
    deleteOrder = function (id) {
        let result = confirm('Do you want to delete Order?');
        //console.log(result); 驗證result 帶入0,1 OK
        
        if (result) {
            let actionUrl ='/orders/'+id;//組合網址
            //console.log(actionurl);位置驗證OK
            //console.log(actionUrl);
            
            $.post(actionUrl,{_method:'delete'}).done(function() {
                location.href = '/orders';//重新整理頁面 
    
            });
    
        };
    
        
    };
    changecount =function (id,value) {

        $.post("/shoppingitems/"+id,{_method:'put',shoppingitem_id:id,count:value}).done(function() {

            location.href = '/shoppingitems';//重新整理頁面 

        });


    }
    removegetgenre= function (id) {
        oldurl = window.location.href;
        newurl=oldurl.replace(`genre_id=${id}`,"");
        console.log(newurl);
        location.href = newurl;
        // "http://localhost:8000/home?&language_id=1"genre_id=8


    };
    removegetyear= function (id) {
        oldurl = window.location.href;
        newurl=oldurl.replace(`year=${id}`,"");
        console.log(newurl);
        location.href = newurl;
        // "http://localhost:8000/home?&language_id=1"genre_id=8


    };
    removegetlanguage= function (id) {
        oldurl = window.location.href;//便會得到網址
        newurl=oldurl.replace(`language_id=${id}`,"");
        console.log(newurl);
        location.href = newurl;
        // "http://localhost:8000/home?&language_id=1"genre_id=8


    };
    changeOrderStatusWait = function (id) {
        let result = confirm('Do you want to change status of order?');

        
        if (result) {
            let actionUrl ='/orders/'+id;//組合網址

            
            $.post(actionUrl,{_method:'put',status:1}).done(function() {
                location.href = '/orders';//重新整理頁面 
    
            });
    
        };
    
        
    };
    
    changeOrderStatusFinish = function (id) {
        let result = confirm('Do you want to change status of order?');
        //console.log(result); 驗證result 帶入0,1 OK
        
        if (result) {
            let actionUrl ='/orders/'+id;//組合網址

            
            $.post(actionUrl,{_method:'put',status:2}).done(function() {
                location.href = '/orders';//重新整理頁面 
    
            });
    
        };
    
        
    };
    changeOrderStatusCancel = function (id) {
        let result = confirm('Do you want to change status of order?');
        //console.log(result); 驗證result 帶入0,1 OK
        
        if (result) {
            let actionUrl ='/orders/'+id;//組合網址

            
            $.post(actionUrl,{_method:'put',status:3}).done(function() {
                location.href = '/orders';//重新整理頁面 
    
            });
    
        };
    
        
    };


    

  
    
    
    const app = new Vue({
        el: '#app',
    });
    

});

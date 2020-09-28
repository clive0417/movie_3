<?php

namespace App\Http\Controllers;
use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\MovieRepository;

use Tmdb\Laravel\Facades\Tmdb; // optional for Laravel ≥5.5
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $testmovie=Tmdb::getMoviesApi()->getMovie(265712);// [不會是在這裡使用，會在創商品頁面時使用]
        //Log::info();
        // 電影海報 --> $testmovi['poster_path']--> 只是前面要加甚麼url [https://image.tmdb.org/t/p/w500/]
        //https://image.tmdb.org/t/p/w500/[API -feedback]
        //  第二個為篩選條件嗎?? $movie = $client->getMoviesApi()->getMovie(550, array('language' => 'en'));
        // 按照電影的ID[請在TMDB 裡面先查]單獨一部電影 $testmovie=Tmdb::getMoviesApi()->getmovie(500);
        // 電影背景 --> $testmovi[''results][i {第i個資料}]['backdrop_path']　
        //　要用的資料
        //  //Log::info("電影海報url"."https://image.tmdb.org/t/p/w500".$testmovie['poster_path']);// 需加 "" 
        //  Log::info("電影年分".$testmovie['release_date']);// 需加 ""
        //  Log::info("電影分數".$testmovie['vote_average']);
        //  Log::info("電影種類-array");
        //  Log::info($testmovie['genres']);
        //  Log::info("電影語言-array");
        //  Log::info($testmovie['spoken_languages']);



        return view('home');
        //return view('home');
    }
}

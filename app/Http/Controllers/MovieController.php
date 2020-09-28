<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Tmdb\Laravel\Facades\Tmdb; // optional for Laravel ≥5.5
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $movie = new Movie; //$movie 變數等於 空白的movie model 做為等下填入資料使用
        return view('movies.create',['movie'=> $movie]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movie;
        $movie ->fill($request->all());
        $movieApiInfo=Tmdb::getMoviesApi()->getMovie($movie['TMDB_id']);
        $movie['posterUrl'] = "https://image.tmdb.org/t/p/w500/".$movieApiInfo['poster_path'];
        $movie['releaseDate'] =$movieApiInfo['release_date'];
        $movie['point']=$movieApiInfo['vote_average'];

        Log::info($movie['price']);
        $movie->save();
        return redirect('/movies');
        
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


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
    }
}

<?php

namespace App\Http\Controllers;
use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\MovieRepository;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
// 匯入DB資料使用model  
use App\Movie;
use App\Genre;
use App\Language;
// 匯入DB資料使用model  

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
        $movies = Movie::all();
        $genres = Genre::all();





        return view('home', ['movies' => $movies,'genres'=> $genres]);
        //return view('home');
    }

    public function indexWithGenre(Genre $genre)
    {
        
        $movies=$genre->movies();
        //Log::info($movies);
        $movies = Movie::whereHas('genres', function($query) use($genre) {
            $query->where('genres.id', $genre['id']);
        })->get();

        $genres = Genre::all();







        return view('home', ['movies' => $movies,'genres'=> $genres]);
        //return view('home');
    }
}

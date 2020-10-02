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
use Illuminate\Support\Facades\Auth;
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
        


        $movies = Movie::whereHas('genres', function($query) use($genre) {
            $query->where('genres.id', $genre['id']);
        })->get();

        $genres = Genre::all();
        return view('home', ['movies' => $movies,'genres'=> $genres]);
        //return view('home');
    }


    public function show(Movie $movie)
    {

        $id = Auth::id();
        $genres = $movie->genres;
        $languages =$movie->languages;
        $genresString = null ;
        
        // 將讀取出來的genres 轉換成 String
        for ($i=0; $i <count($genres); $i++) {
            //Log::info($genres[$i]['name'] );
            $genresString=$genresString.$genres[$i]['name'];
            $genresString=$genresString. ",";
            
        }
        $languagesString = null ;
        for ($i=0; $i <count($languages); $i++) {
            //Log::info($genres[$i]['name'] );
            $languagesString = $languagesString.$languages[$i]['name'];
            $languagesString = $languagesString. ",";
            
        }






        return view('show', ['movie' => $movie,'genresString' =>$genresString, 'languagesString' => $languagesString,'user_id' => $id]);
        //return view('home');
    }
}

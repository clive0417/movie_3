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
    public function index(Request $request)
    {

 
        $movies = new Movie;

        $years= Movie::all()->pluck('year'); 
        $genres = Genre::all();
        $languages =Language::all();
        $request->get('genre_id','language_id');

        

        // $XX=var_dump($movies2);
        // Log::info('get'.$XX);
        if (isset($request['genre_id'])) {
            $movies = $movies->whereHas('genres', function($genrequery) use($request) {
                $genrequery->where('genres.id', $request['genre_id']);
            });
        };
        if (isset($request['language_id'])) {
            $movies = $movies->whereHas('languages', function($languagequery) use($request) {
                $languagequery->where('languages.id', $request['language_id']);
            });
        };
        if (isset($request['year'])) {
            $movies = $movies->where('year', $request['year']);

        };

        $genres = Genre::all();
        $languages =Language::all();
        $movies = $movies->get();

        











        return view('home', ['movies' => $movies,'languages'=>$languages,'genres'=> $genres,'years'=>$years]);
        // 
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

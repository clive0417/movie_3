<?php

namespace App\Http\Controllers;
use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\MovieRepository;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
// 匯入DB資料使用model  
use DB;
use App\Movie;
use App\Genre;
use App\Language;
use Illuminate\Support\Facades\Auth;
// 匯入DB資料使用model  

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

 
        $movies = new Movie;



        $request->get('genre_id','language_id','year','search');

        

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
        if (isset($request['search'])) {
            $movies = $movies->where('title', 'LIKE','%'.$request['search'].'%');


        };


        // $languages =Language::all();
        $years = $movies->groupBy('year')->orderby('year', 'DESC')->pluck('year');
        

        $movies = $movies->get();
        $genres_id_array= array();
        $languages_id_array= array();
        foreach ($movies as $key => $movie) {
            $movieid=$movie->id;
            //genre重整
            $genresForArrary = Genre::whereHas('movies', function($moviequery) use($movieid) {
                $moviequery->where('movies.id', $movieid);

            });
            $genresForArrary=$genresForArrary->get();
            foreach ($genresForArrary as $key => $genre) {
                if (!in_array($genre->id,$genres_id_array))
                array_push($genres_id_array,$genre->id);
            };
            //language重整
            
            $languagesForArrary = Language::whereHas('movies', function($moviequery) use($movieid) {
                $moviequery->where('movies.id', $movieid);

            });
            $languagesForArrary=$languagesForArrary->get();
            //  Log::info($languages);
            foreach ($languagesForArrary as $key => $language) {
                if (!in_array($language->id,$languages_id_array))
                array_push($languages_id_array,$language->id);
            };
        };
        // Log::info($genres_id_array);
        $genres = DB::table('genres')->whereIn('id', $genres_id_array)->orderBy('name','asc')->get();
        $languages = DB::table('languages')->whereIn('id', $languages_id_array)->orderBy('name','asc')->get();






        











        return view('home', ['movies' => $movies,'languages'=>$languages,'genres'=> $genres,'years'=>$years,'request'=>$request]);
        // 
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

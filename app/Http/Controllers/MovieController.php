<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Movie;
use App\Movievideo;
use App\Genre;
use App\Language;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Tmdb\Laravel\Facades\Tmdb; // optional for Laravel ≥5.5
use Illuminate\Support\Facades\Log;
use Tmdb\Repository\SearchRepository;

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



        return view('movies.create', ['movie' => $movie]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        //處理電影資料匯入
        $movie = new Movie;
        $movie->fill($request->all());


        
        $movieCreditrApiInfo = Tmdb::getMoviesApi()->getCredits($movie['TMDB_id']);
        // Log::info($movieCreditrApiInfo);
        $movieApiInfo = Tmdb::getMoviesApi()->getMovie($movie['TMDB_id'], array('language' => 'zh'));
        $movie['posterUrl'] = "https://image.tmdb.org/t/p/w500/" . $movieApiInfo['poster_path'];
        $movie['releaseDate'] = $movieApiInfo['release_date'];
        $movie['point'] = $movieApiInfo['vote_average'];
        $movie['overview'] = $movieApiInfo['overview'];
        $dateArray = explode("-",  $movie['releaseDate']);
        $movie['year'] = $dateArray[0];


        $movie->save();
        //處理video 匯入
        $movieViedoApiInfo = Tmdb::getMoviesApi()->getVideos($movie['TMDB_id']);
        // Log::info($movieViedoApiInfo);
        if (!empty($movieViedoApiInfo['results'])) {
            for ($i = 0; $i < count($movieViedoApiInfo['results']); $i++) {
                $movieVideos = new Movievideo;
                $movieVideos['viedoUrl'] = "https://www.youtube.com/embed/" . $movieViedoApiInfo['results'][$i]['key'];
                $movieVideos['movie_id'] = $movie->id;
                $movieVideos->save();
                // Log::info($movieViedoApiInfo['results'][$i]['key']);
                # code...
            }
        };

        // Log::info($movieVideos);
        //處理video 匯入 end
        // 處理actor 匯入
        $movieCreditrApiInfo = Tmdb::getMoviesApi()->getCredits($movie['TMDB_id']);
        // Log::info($movieCreditrApiInfo['cast']);
        $actorDataArray = [];
        //組array
        if (count($movieCreditrApiInfo['cast']) > 4) {
            for ($i = 0; $i < 4; $i++) {
                array_push($actorDataArray,$movieCreditrApiInfo['cast'][$i]['name']);
            };
        } else {
            for ($i = 0; $i < count($movieCreditrApiInfo['cast']); $i++) {
                array_push($actorDataArray, $movieCreditrApiInfo['cast'][$i]['name']);
            };
        };
        foreach ($actorDataArray as $key => $actor) {
            $model = Actor::firstOrCreate(['name' => $actor]);
            $movie->actors()->attach($model->id);
        }
        // Log::info($actorDataArray);




        //處理genre資料填入 start
        //
        $genreDataArray = [];
        $genreApiArray = $movieApiInfo['genres'];

        // 將API 資料轉成單純的已key 為0,1,2,.... 的Array 
        foreach ($genreApiArray as $key => $genrename) {
            array_push($genreDataArray, $genrename['name']);
        }



        //用for each firstOrcreate [帶入圍單純數字為key的array]
        foreach ($genreDataArray as $key => $genre) {
            $model = Genre::firstOrCreate(['name' => $genre]);
            $movie->genres()->attach($model->id);
        }

        //處理genre資料填入 end

        //處理language 資料填入 start 
        $languageDataArray = [];
        $languageApiArray = $movieApiInfo['spoken_languages'];
        foreach ($languageApiArray as $key => $languagename) {
            array_push($languageDataArray, $languagename['name']);
        }
        //用for each firstOrcreate [帶入圍單純數字為key的array]
        foreach ($languageDataArray as $key => $language) {
            $model = Language::firstOrCreate(['name' => $language]);
            $movie->languages()->attach($model->id);
        }


        //處理language 資料填入 end 


        return redirect('/movies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {

        $id = Auth::id();
        $genres = $movie->genres;
        $languages = $movie->languages;
        $actors = $movie->actors;


        // 將讀取出來的genres 轉換成 String
        $genresString = null;
        for ($i = 0; $i < count($genres); $i++) {
            //Log::info($genres[$i]['name'] );
            $genresString = $genresString . $genres[$i]['name'];
            $genresString = $genresString . ",";
        }
        // 將讀取出來的languages 轉換成 String
        $languagesString = null;
        for ($i = 0; $i < count($languages); $i++) {
            //Log::info($genres[$i]['name'] );
            $languagesString = $languagesString . $languages[$i]['name'];
            $languagesString = $languagesString . ",";
        }






        return view('movies.show', ['movie' => $movie, 'genresString' => $genresString, 'languagesString' => $languagesString, 'user_id' => $id,'actors'=>$actors]);
        //return view('home');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {

        $genres = $movie->genres;
        $genresString = null;

        // 將讀取出來的genres 轉換成 String
        for ($i = 0; $i < count($genres); $i++) {
            //Log::info($genres[$i]['name'] );
            $genresString = $genresString . $genres[$i]['name'];
            $genresString = $genresString . ",";
        }
        //end





        // 將讀取出來的languages  轉換成 String
        $languages = $movie->languages;
        $languagesString = null;
        for ($i = 0; $i < count($languages); $i++) {
            //Log::info($genres[$i]['name'] );
            $languagesString = $languagesString . $languages[$i]['name'];
            $languagesString = $languagesString . ",";
        }
        // 將讀取出來的genresString 轉換成 以數字的array 


        // end



        $isCreate = request()->is('*create');
        return view('movies.edit', ['movie' => $movie, 'isCreate' => $isCreate, 'genresString' => $genresString, 'languagesString' => $languagesString]);
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
        // 電影table 填入資料
        $movie->fill($request->all());
        $movie->save();
        Log::info($request);

        // 處理genres 重新寫入DB
        $movie->genres()->detach();
        $genresArray = explode(',', $request['genresString']);
        $genresArray = array_filter($genresArray);
        //Log::info($genresArray);
        foreach ($genresArray as $key => $genre) {
            $model = Genre::firstOrCreate(['name' => $genre]);
            $movie->genres()->attach($model->id);
        }
        // 處理genres end

        // 處理languages 重新寫入DB
        $movie->languages()->detach();
        $languagesArray = explode(',', $request['languagesString']);
        $languagesArray = array_filter($languagesArray);
        // Log::info($languagesArray);
        foreach ($languagesArray as $key => $language) {
            $model = Language::firstOrCreate(['name' => $language]);
            $movie->languages()->attach($model->id);
        }
        // 處理languages end



        return redirect('/movies');
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


    public function searchTMDBID (Request $request,Movie $movie)
    {
        $movie = new Movie; //$movie 變數等於 空白的movie model 做為等下填入資料使用
        // 處理搜尋結果
        // $request->get('searchTMDB');
        // $searchmovie= Tmdb::getSearchApi()->searchMovies($_GET['searchTMDB']);
        Log::info($_GET);
        // $searchmovieArrays=$searchmovie['results'];
        // Log::info($searchmovieArrays);
        // return view('movies.create', ['movie' => $movie,'searchmovieArrays'=>$searchmovieArrays]);



        return view('movies.create', ['movie' => $movie]);

        
    }
}

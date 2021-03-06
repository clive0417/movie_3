@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $key => $error)
        <li>{{$error}}</li>


        @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{ $actionUrl = ($isCreate)? '/movies' :'/movies/'.$movie->id}}">

    <!--csrf 塞 session token 去跨過csrf -->
    @csrf
    @if(!$isCreate)
    <!--傳統HTML只支持，post/get 不支持put/delete laravel 要特別加 -->
    <input type="hidden" name="_method" value="put">
    @endif

    <div class="form-group">
        <label class="text-white lead">電影名稱</label>
        <input name="title" class="form-control" value="{{$movie->title}}">
        <br>
        <label class="text-white lead">TMDB ID [請至TMDB官網查詢]</label>
        <input name="TMDB_id" class="form-control" value="{{$movie->TMDB_id}}">
        <br>
        <label class="text-white lead">價格</label>
        <input name="price" class="form-control" value="{{$movie->price}}">
        <br>
        <label class="text-white lead">上映日期</label>
        <input name="releaseDate" class="form-control" value="{{$movie->releaseDate}}">        
        <br>
        <label class="text-white lead">描述</label>
        <textarea  name="overview" class="form-control" rows="4" cols="50">
        {{$movie->overview}}
        </textarea>
        <br>
        <label class="text-white lead" >語言 [多重項目請以","做分隔]</label>
        <input name="languagesString" class="form-control" value="{{$languagesString}}">
        <br>
        <label class="text-white lead">分類 [多重項目請以","做分隔]</label>
        <input name="genresString" class="form-control" value="{{$genresString}}">
        <br>
        <label class="text-white lead">電影海報</label>
        <br>
        <img src="{{$movie->posterUrl}}" alt="電影海報空缺">




    </div>
    <div class="form-group">


        <button type="submit" class="btn btn-primary">送出</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">取消</button>
</form>
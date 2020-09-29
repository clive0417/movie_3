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
        <label>Title</label>
        <input name="title" class="form-control" value="{{$movie->title}}">
        <label>TMDB ID [請至TMDB官網查詢]</label>
        <input name="TMDB_id" class="form-control" value="{{$movie->TMDB_id}}">
        <label>價格</label>
        <input name="price" class="form-control" value="{{$movie->price}}">
        <label>上映日期</label>
        <input name="releaseDate" class="form-control" value="{{$movie->releaseDate}}">

        <label>Overview</label>
        <textarea name="overview" class="form-control" rows="4" cols="50">
        {{$movie->overview}}
        </textarea>
        <br>
        <label>電影海報</label>
        <br>
        <img src="{{$movie->posterUrl}}" alt="電影海報空缺">




    </div>
    <div class="form-group">


        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" onclick="window.history.back()">cancel</button>
</form>
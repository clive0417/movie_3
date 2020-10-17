@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $key => $error)
        <li>{{$error}}</li>


        @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{ $actionUrl =  '/movies' }}">

    <!--csrf 塞 session token 去跨過csrf -->
    @csrf


    <div class="form-group">
        <label class="text-white lead">電影名稱</label>
        <input name="title" class="form-control" value="{{$movie->title}}">
        <br>
        <label class="text-white lead">TMDB ID [請至TMDB官網查詢 或使用下面的TMDBID搜尋]</label>
        <input name="TMDB_id" class="form-control" value="{{$movie->TMDB_id}}">
        <br>
        <label class="text-white lead">價格</label>
        <input name="price" class="form-control" value="{{$movie->price}}">
        <br>





    </div>
    <div class="form-group">


        <button type="submit" class="btn btn-primary">送出</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">取消</button>
    </div>
</form>

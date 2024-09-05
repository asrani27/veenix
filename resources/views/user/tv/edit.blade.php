@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit TV Series</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="/user/tv/edit/{{$data->id}}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Title </label>
                            <input type="text" class="form-control" name="title" value="{{$data->title}}" required>
                        </div>
                        <div class="form-group">
                            <label>Description </label>
                            <textarea class="form-control" rows="3" name="description">{{$data->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Genre  (Pisahkan dengan tanda comma ,)</label>
                            <input type="text" class="form-control" name="genre" value="{{$data->genre}}" required>
                        </div>
                        <div class="form-group">
                            <label>Actor (Pisahkan dengan tanda comma ,)</label>
                            <input type="text" class="form-control" name="actor" value="{{$data->actor}}" required>
                        </div>
                        <div class="form-group">
                            <label>Country (Pisahkan dengan tanda comma ,)</label>
                            <input type="text" class="form-control" name="country" value="{{$data->country}}" required>
                        </div>
                        <div class="form-group">
                            <label>Director</label>
                            <input type="text" class="form-control" name="director" value="{{$data->director}}" required>
                        </div>
                        <div class="form-group">
                            <label>Quality</label>
                            <input type="text" class="form-control" name="quality" value="{{$data->quality}}" required>
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <input type="text" class="form-control" name="duration" value="{{$data->duration}}" required>
                        </div>
                        <div class="form-group">
                            <label>Network</label>
                            <input type="text" class="form-control" name="network" value="{{$data->network}}" required>
                        </div>
                        <div class="form-group">
                            <label>Total Episode</label>
                            <input type="text" class="form-control" name="total_episode" value="{{$data->total_episode}}" required>
                        </div>
                        <div class="form-group">
                            <label>IMDB</label>
                            <input type="text" class="form-control" name="imdb" value="{{$data->imdb}}">
                        </div>
                        <div class="form-group">
                            <label>Link Video</label>
                            <textarea class="form-control" rows="3" name="link_video">{{$data->link_video}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Link Download (bila lebih dari 1 Pisahkan dengan tanda comma ,)</label>
                            <textarea class="form-control" rows="3" name="link_download">{{$data->link_download}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Image (Max 1MB)</label>
                            <input type="file" name="image">
                            <br/>
                            <img src="{{$data->image}}" width="175" height="270">
                        </div>
                        <div class="form-group">
                            <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
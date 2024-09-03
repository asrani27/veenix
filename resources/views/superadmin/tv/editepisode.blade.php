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
                    <form method="post" action="/superadmin/tv/episode/edit/{{$data->id}}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Season {{$data->season}}, Episode {{$data->episode}} </label>
                        </div>
                        <div class="form-group">
                            <label>Title </label>
                            <input type="text" class="form-control" name="title" value="{{$data->title}}" required>
                        </div>
                        <div class="form-group">
                            <label>Description </label>
                            <input type="text" class="form-control" name="description" value="{{$data->description}}" required>
                        </div>
                        <div class="form-group">
                            <label>Quality </label>
                            <textarea class="form-control" rows="3" name="quality">{{$data->quality}}</textarea>
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
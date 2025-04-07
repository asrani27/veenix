@extends('layouts.app')

@section('content')
<br />
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Movie</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="/user/post/create" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title </label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>Description </label>
                            <textarea class="form-control" rows="3" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Genre (Pisahkan dengan tanda comma ,)</label>
                            <input type="text" class="form-control" name="genre" required>
                        </div>
                        <div class="form-group">
                            <label>Actor (Pisahkan dengan tanda comma ,)</label>
                            <input type="text" class="form-control" name="actor" required>
                        </div>
                        <div class="form-group">
                            <label>Country (Pisahkan dengan tanda comma ,)</label>
                            <input type="text" class="form-control" name="country" required>
                        </div>
                        <div class="form-group">
                            <label>Director</label>
                            <input type="text" class="form-control" name="director" required>
                        </div>
                        <div class="form-group">
                            <label>Quality</label>
                            <input type="text" class="form-control" name="quality" required>
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <input type="text" class="form-control" name="duration" required>
                        </div>
                        <div class="form-group">
                            <label>IMDB</label>
                            <input type="text" class="form-control" name="imdb">
                        </div>
                        <div class="form-group">
                            <label>Link Video</label>
                            <textarea class="form-control" rows="3" name="link_video"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Link Download (bila lebih dari 1 Pisahkan dengan tanda comma ,)</label>
                            <textarea class="form-control" rows="3" name="link_download"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image (Max 1MB)</label>
                            <input type="file" name="image">
                            <br />
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="/muvnix/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/muvnix/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('content')
<br/>
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fas fa-play"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Movie</span>
          <span class="info-box-number">{{totalMoview()}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-success"><i class="fas fa-film"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">TV Series</span>
          <span class="info-box-number">0</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-warning"><i class="fas fa-globe"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Dead Link Video</span>
          <span class="info-box-number">0
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-danger"><i class="fas fa-comment"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">No Link Download</span>
          <span class="info-box-number">{{noLinkDownload()}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<h5 class="mb-2">Top Movie</h5>
<div class="row">
    <div class="col-10">
      <form method="post" action="/superadmin/topmovie">
        @csrf
      <select class="form-control select2" name="movie_id" required>
        <option value="">-</option>
        @foreach (movie() as $item)
            <option value="{{$item->id}}">{{$item->title}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-2">
      <button type="submit" class="btn btn-primary btn-block">Tambahkan</button>
    </div>
  </form>
  <br/><br/>
  <div class="col-12">
      <div class="card">
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <td>#</td>
              <td>Image</td>
              <td>Title</td>
            </tr>
          </thead>
          <tbody>
            @foreach (topmovie() as $key=> $item)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td><img src="{{$item->image}}" width="10%"></td>
                  <td>{{$item->title}}</td>
                  <td>
                    <a href="/superadmin/topmovie/delete/{{$item->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
</div>

@endsection

@push('js')
<script src="/muvnix/plugins/select2/js/select2.full.min.js"></script>
<script>
   $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
@endpush
@extends('layouts.app')

@push('css')
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
{{-- <div class="row">
    <div class="col-md-3 col-sm-6 col-12">
    </div>
    <div class="col-md-3 col-sm-6 col-12">
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <a href="/superadmin/deadlinkvideo" class="btn btn-sm btn-primary btn-block"><i class="fa fa-sync"></i> Proses</a>
      <a href="/superadmin/deadlinkvideo/list" class="btn btn-sm btn-danger btn-block"><i class="fa fa-eye"></i> Lihat</a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
    </div>
</div> --}}
@endsection
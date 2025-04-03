@extends('visit.app')
@push('meta')
<title>Nonton {{$data->title}} Subtitle Indonesia</title>
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="description" content="{{$data->description}}">
<meta property="og:locale" content="id_ID">
<meta property="og:type" content="website">
<meta property="og:title" content="Nonton {{$data->title}} Subtitle Indonesia">
<meta property="og:description" content="{{$data->description}}">
<meta property="og:url" content="{{ secure_url(Request::path()) }}">
<meta property="og:site_name" content="VEENIX - INDOFILM: Nonton Film LK21 dan Bioskopkeren Layarkaca21 XXI">

<meta name="copyright" content="VEENIX">
<meta name="rating" content="general">
<meta name="geo.placename" content="Indonesia">
<meta name="geo.country" content="ID">
<meta name="language" content="ID">
<meta name="tgn.nation" content="Indonesia">
<meta name="author" content="VEENIX">
<meta name="distribution" content="global">
<meta name="publisher" content="VEENIX, Inc.">
<meta name="Slurp" content="all">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('css')


<style>
  iframe {
    width: 100%;
    aspect-ratio: 16 / 9;
  }

  #uppy {
    width: 100%;
    height: 500px;
  }
</style>
@endpush
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ol class="breadcrumb float-sm-left" style="background-color:#ffff0003;padding-left:0px">
        <li class="breadcrumb-item"><a href="/">Home</a></li>

        @foreach (json_decode($data->genre) as $item)

        <li class="breadcrumb-item"><a href="/genre/{{$item}}">{{$item}}</a></li>
        @endforeach
        <li class="breadcrumb-item active">{{$data->title}}, Episode : {{$data->title}}</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">


      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-2 text-center">
              <img src="{{$data->image}}" width="185px" height="275px">
            </div>
            <div class="col-sm-7" style="padding-left:25px">
              <h4><strong>{{$data->title}} : {{$data->title}} </strong></h4>
              {{$data->description}}
              <br /><br />
              <strong>Views: </strong>{{$data->views}}<br />

              <strong>Genre: </strong>
              @if ($data->genre != null)

              @foreach (json_decode($data->genre) as $item)
              <a href="/genre/{{$item}}">{{$item}}</a>,
              @endforeach
              @endif
              <br />

              <strong>Director: </strong>{{$data->director}}<br />

              <strong>Actors: </strong>
              @if ($data->actor != null)
              @foreach (json_decode($data->actor) as $item)
              {{$item}},
              @endforeach
              <br />
              @endif

              <strong>Country: </strong>
              @if ($data->country != null)
              @foreach (json_decode($data->country) as $item)
              {{$item}},
              @endforeach<br />
              @endif
              <strong>Duration: </strong> {{$data->duration}}<br />

              <strong>Release: </strong> {{$data->release}}<br />

              <strong>IMDb: </strong>{{$data->imdb == null ? 'N/A': $data->imdb}}<br />
              <strong>Quality: </strong> {{$data->quality}}<br />
            </div>
            <div class="col-sm-3 text-center">

            </div>
          </div>

        </div>
      </div>
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">LIST EPISODE</h3>

          <div class="card-tools">

          </div>
          <!-- /.card-tools -->
        </div>
        <div class="card-body">
          @foreach ($semuaEpisode as $key => $item)
          @if ($item->id == $data->id)

          <a href="/tv/{{$data->slug}}/season-{{$item->season}}/episode-{{$item->episode}}" class="btn btn-primary"><i
              class="fas fa-play"></i> S{{$item->season}} Ep {{$item->episode}}</a>
          @else

          <a href="/tv/{{$data->slug}}/season-{{$item->season}}/episode-{{$item->episode}}" class="btn btn-default"><i
              class="fas fa-play"></i> S{{$item->season}} Ep {{$item->episode}}</a>
          @endif
          @endforeach
        </div>
      </div>
    </div><!-- /.col -->

  </div>

</div>

@endsection

@push('js')

@endpush
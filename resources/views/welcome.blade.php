@extends('visit.app')
@push('meta')
<title>VEENIX - LK21, INDOXXI, IDLIX, Situs Nonton Film Streaming Gratis Subtitle Indonesia</title>
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="description" content="VEENIX - INDO FILM Sebagai Situs Nonton Film LK21 Bioskop Keren Layarkaca21 XXI Online Terlengkap dan Download Streaming Movie Sub Indo Gratis.">
<meta property="og:locale" content="id_ID">
<meta property="og:type" content="website">
<meta property="og:title" content="VEENIX - INDOFILM: Nonton Film LK21 dan Bioskopkeren Layarkaca21 XXI">
<meta property="og:description" content="VEENIX - INDO FILM Sebagai Situs Nonton Film LK21 Bioskop Keren Layarkaca21 XXI Online Terlengkap dan Download Streaming Movie Sub Indo Gratis.">
<meta property="og:url" content="https://veenix.online/">
<meta property="og:site_name" content="VEENIX - INDOFILM: Nonton Film LK21 dan Bioskopkeren Layarkaca21 XXI">

<meta name="copyright" content="INDOFILM">
<meta name="rating" content="general">
<meta name="geo.placename" content="Indonesia">
<meta name="geo.country" content="ID">
<meta name="language" content="ID">
<meta name="tgn.nation" content="Indonesia">
<meta name="author" content="INDOFILM">
<meta name="distribution" content="global">
<meta name="publisher" content="INDOFILM, Inc.">
<meta name="Slurp" content="all">
@endpush
@push('css')
  <style>
    .card a:hover{
      box-shadow: 2px -1px 5px 11px rgba(0,0,0,0.26); 
      -webkit-box-shadow: 2px -1px 5px 11px rgba(0,0,0,0.26);
      -moz-box-shadow: 2px -1px 5px 11px rgba(0,0,0,0.26);
      background-color: gray;
    }
    </style>
@endpush
@section('content')
    <div class="container" style="max-width: 1440px">
        <h3>Top Movies</h3>
        <div class="row">
            @foreach (topmovie() as $item)
            <div class="col-lg-2 col-6" style="max-width: 180px;">
                <div class="card card-widget widget-user">
                    <a href="/movie/{{$item->slug}}">
                        <div class="widget-user-header text-white text-right" style="background: url('{{$item->image}}') center center; background-size:cover; height:260px;border-radius:.25rem; padding:0px;box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -webkit-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -moz-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset;">
                            <span class="badge bg-gradient-yellow" style="padding:6px 6px; margin-top:0px; font-size:16px">{{$item->quality}}</span><br/>
                            
                            @include('title');
                            
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-6">
                <h3>Latest Movies</h3>
            </div>
            <div class="col-sm-6">
              <div class="float-sm-right">
                <a href="/latest-movies" class="btn btn-sm btn-primary">View More <i class="fa fa-arrow-right"></i> </a>
              </div>
            </div>
        </div>
        <div class="row">
            @foreach (latestMovies() as $item)
            <div class="col-lg-2 col-6" style="max-width: 180px;">
                <div class="card card-widget widget-user">
                    <a href="/movie/{{$item->slug}}">
                        <div class="widget-user-header text-white text-right" style="background: url('{{$item->image}}') center center; background-size:cover; height:260px;border-radius:.25rem; padding:0px;box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -webkit-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -moz-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset;">
                            <span class="badge bg-gradient-yellow" style="padding:6px 6px; margin-top:0px; font-size:16px">{{$item->quality}}</span><br/>
                           
                            
                            @include('title');
                            
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <hr>

        <h3>Latest Series</h3>
        <div class="row">

            @foreach (latestSeries() as $item)
            <div class="col-lg-2 col-6" style="max-width: 180px;">
                <div class="card card-widget widget-user">
                    <a href="/tv/{{$item->tvseries->slug}}/season-{{$item->season}}/episode-{{$item->episode}}">
                        <div class="widget-user-header text-white text-right" style="background: url('{{$item->tvseries->image}}') center center; height:260px;border-radius:.25rem; padding:0px;box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -webkit-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -moz-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset;">
                            <span class="badge bg-gradient-warning" style="padding:6px 6px; margin-top:0px; font-size:16px">S{{$item->season}} - Eps. {{$item->episode}}</span><br/>
                            <h2 class="widget-user-desc text-center" style="margin-top: 190px; font-size:14px;">{!!wordwrap($item->tvseries->title, 20,'<br/>')!!}</h2>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    
@endsection
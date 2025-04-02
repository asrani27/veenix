@extends('visit.app')
@push('meta')
<title>VEENIX Nonton Film {{$search}} Subtitle Indonesia</title>
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="description" content="VEENIX Nonton Film {{$search}} Subtitle Indonesia">
<meta property="og:locale" content="id_ID">
<meta property="og:type" content="website">
<meta property="og:title" content="VEENIX Nonton Film {{$search}} Subtitle Indonesia">
<meta property="og:description" content="VEENIX Nonton Film {{$search}} Subtitle Indonesia">

<meta property="og:url" content="{{ secure_url(Request::path()) }}">
<meta property="og:site_name" content="VEENIX - INDOFILM: Nonton Film LK21 dan Bioskopkeren Layarkaca21 XXI">
@endpush
@push('css')

<style>
    .card a:hover {
        box-shadow: 2px -1px 5px 11px rgba(0, 0, 0, 0.26);
        -webkit-box-shadow: 2px -1px 5px 11px rgba(0, 0, 0, 0.26);
        -moz-box-shadow: 2px -1px 5px 11px rgba(0, 0, 0, 0.26);
        background-color: gray;
    }
</style>
@endpush
@section('content')
<div class="container" style="max-width: 1440px">
    <h3>Search Movie : {{$search}}</h3>
    <div class="row">
        @foreach ($data as $item)
        <div class="col-lg-2 col-6" style="max-width: 180px;">
            <div class="card card-widget widget-user">
                @if ($item->total_episode == null)
                <a href="/movie/{{$item->slug}}">
                    @else
                    <a href="/tv/{{$item->slug}}">
                        @endif
                        <div class="widget-user-header text-white text-right"
                            style="background: url('{{$item->image}}') center center; background-size:cover; height:260px;border-radius:.25rem; padding:0px;box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -webkit-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -moz-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset;">
                            <div class="d-flex justify-content-between">

                                <span class="badge bg-gradient-yellow"
                                    style="padding:6px 6px; margin-top:0px; font-size:14px">
                                    <i class="fa fa-star"></i> {{$item->imdb}}</span>

                                <span class="badge bg-gradient-yellow"
                                    style="padding:6px 6px; margin-top:0px; font-size:14px">{{$item->quality}}</span>
                            </div>
                            @include('title')
                        </div>
                    </a>
            </div>
        </div>
        @endforeach
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12 text-center">
            {{$data->links()}}
        </div>
    </div>
</div>


@endsection
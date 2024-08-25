@extends('visit.app')
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
            @foreach (topMovies() as $item)
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

        <h3>Latest Movies</h3>
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

        {{-- <h3>Latest Series</h3>
        <div class="row">
            <div class="col-lg-2 col-6" style="max-width: 180px;">
                <div class="card card-widget widget-user">
                    <a href="#">
                        <div class="widget-user-header text-white text-right" style="background: url('https://image.tmdb.org/t/p/w185/avy7IR8UMlIIyE2BPCI4plW4Csc.jpg') center center; height:260px;border-radius:.25rem; padding:0px;box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -webkit-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -moz-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset;">
                            <span class="badge bg-gradient-warning" style="padding:6px 6px; margin-top:0px; font-size:16px">Eps. 7</span><br/>
                            <h2 class="widget-user-desc text-center" style="margin-top: 190px; font-size:14px;">{!!wordwrap('Guardians of the Galaxy Vol. 2', 20,'<br/>')!!}</h2>
                            
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}
    </div>

    
@endsection
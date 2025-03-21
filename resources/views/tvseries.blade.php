@extends('visit.app')
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
    <h3>Latest TV Series :</h3>
    <div class="row">
        @foreach ($data as $item)
        <div class="col-lg-2 col-6" style="max-width: 180px;">
            <div class="card card-widget widget-user">
                <a href="/tv/{{$item->slug}}">
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
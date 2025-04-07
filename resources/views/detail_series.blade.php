@extends('visit.app')
@push('meta')
<title>Nonton {{$data->tvseries->title}} Subtitle Indonesia</title>
<!-- Meta Utama -->
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="description"
  content="Nonton {{ $data->tvseries->title }} subtitle Indonesia streaming online gratis. {{ $data->tvseries->description }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="video.movie">
<meta property="og:title" content="Nonton {{ $data->tvseries->title }} Subtitle Indonesia">
<meta property="og:description" content="{{ $data->tvseries->description }}">
<meta property="og:url" content="{{ secure_url(Request::path()) }}">
<meta property="og:site_name" content="VEENIX - Nonton Film Online">
<meta property="og:image" content="{{ $data->tvseries->image }}">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Nonton {{ $data->tvseries->title }} Subtitle Indonesia">
<meta name="twitter:description" content="{{ $data->tvseries->description }}">

<!-- Geotargeting -->
<meta name="geo.region" content="ID">
<meta name="geo.placename" content="Indonesia">
<meta name="language" content="Indonesian">

<!-- Hak Cipta & Publisher -->
<meta name="copyright" content="© 2024 VEENIX. All Rights Reserved.">
<meta name="publisher" content="VEENIX">

<!-- Schema.org -->
<script type="application/ld+json">
  {
  "@context": "https://schema.org",
  "@type": "Movie",
  "name": "{{ $data->tvseries->title }}",
  "description": "{{ $data->tvseries->description }}",
  "image": "{{ $data->tvseries->image }}",
  "director": "{{ $data->tvseries->director }}",
  "actor": [
    @foreach (json_decode($data->tvseries->actor) as $actor)
      "{{ $actor }}"{{ !$loop->last ? ',' : '' }}
    @endforeach
  ],
  "datePublished": "{{ $data->tvseries->release }}"
}
</script>

<!-- Canonical URL -->
<link rel="canonical" href="{{ secure_url(Request::path()) }}" />
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

        @foreach (json_decode($data->tvseries->genre) as $item)

        <li class="breadcrumb-item"><a href="/genre/{{$item}}">{{$item}}</a></li>
        @endforeach
        <li class="breadcrumb-item active">{{$data->tvseries->title}}, Episode : {{$data->title}}</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <iframe style="width: 100%; height: 80%; overflow: hidden;" frameBorder="0" allowfullscreen="true"
          webkitallowfullscreen="true" mozallowfullscreen="true" src="{{$data->link_video}}"></iframe>
      </div>

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">SEMUA EPISODE</h3>

          <div class="card-tools">

          </div>
          <!-- /.card-tools -->
        </div>
        <div class="card-body">
          @foreach ($semuaEpisode as $key => $item)
          @if ($item->id == $data->id)

          <a href="/tv/{{$data->tvseries->slug}}/season-{{$item->season}}/episode-{{$item->episode}}"
            class="btn btn-primary"><i class="fas fa-play"></i> S{{$item->season}} Ep {{$item->episode}}</a>
          @else

          <a href="/tv/{{$data->tvseries->slug}}/season-{{$item->season}}/episode-{{$item->episode}}"
            class="btn btn-default"><i class="fas fa-play"></i> S{{$item->season}} Ep {{$item->episode}}</a>
          @endif
          @endforeach
        </div>
      </div>

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">LINK DOWNLOAD</h3>

          <div class="card-tools">

          </div>
          <!-- /.card-tools -->
        </div>
        <div class="card-body">
          <a href="{{str_replace('/stream/', '/view/', $data->link_video)}}" class="btn btn-primary" target="_blank"><i
              class="fas fa-download"></i>
            NagaFile.Top (Recomended Link)</a>
          {{-- @if ($data->link_download != null)
          @foreach (json_decode($data->link_download) as $key => $item)
          <a href="{{$item}}" class="btn btn-primary" target="_blank"><i class="fas fa-download"></i> Download {{$key +
            1}}</a>
          @endforeach
          @endif --}}
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-2 text-center">
              <img src="{{$data->tvseries->image}}" width="185px" height="275px">
            </div>
            <div class="col-sm-7" style="padding-left:25px">
              <h4><strong>{{$data->tvseries->title}} : {{$data->title}} </strong></h4>
              {{$data->description}}
              <br /><br />
              <strong>Views: </strong>{{$data->tvseries->views}}<br />

              <strong>Genre: </strong>
              @if ($data->tvseries->genre != null)

              @foreach (json_decode($data->tvseries->genre) as $item)
              <a href="/genre/{{$item}}">{{$item}}</a>,
              @endforeach
              @endif
              <br />

              <strong>Director: </strong>{{$data->tvseries->director}}<br />

              <strong>Actors: </strong>
              @if ($data->tvseries->actor != null)
              @foreach (json_decode($data->tvseries->actor) as $item)
              {{$item}},
              @endforeach
              <br />
              @endif

              <strong>Country: </strong>
              @if ($data->tvseries->country != null)
              @foreach (json_decode($data->tvseries->country) as $item)
              {{$item}},
              @endforeach<br />
              @endif
              <strong>Duration: </strong> {{$data->tvseries->duration}}<br />

              <strong>Release: </strong> {{$data->tvseries->release}}<br />

              <strong>IMDb: </strong>{{$data->tvseries->imdb == null ? 'N/A': $data->tvseries->imdb}}<br />
              <strong>Quality: </strong> {{$data->tvseries->quality}}<br />
            </div>
            <div class="col-sm-3 text-center">

            </div>
          </div>

        </div>
      </div>
      <div id="disqus_thread"></div>
    </div><!-- /.col -->

  </div>


</div>

@endsection

@push('js')
<script>
  (function() { // DON'T EDIT BELOW THIS LINE
  var d = document, s = d.createElement('script');
  s.src = 'https://veenix-online.disqus.com/embed.js';
  s.setAttribute('data-timestamp', +new Date());
  (d.head || d.body).appendChild(s);
  })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
    Disqus.</a></noscript>
@endpush
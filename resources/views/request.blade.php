@extends('visit.app')
@push('meta')
<title>Request Film Subtitle Indonesia</title>
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="description" content="Request Film Subtitle Indonesia">
<meta property="og:locale" content="id_ID">
<meta property="og:type" content="website">
<meta property="og:title" content="Request Film Subtitle Indonesia">
<meta property="og:description" content="Request Film Subtitle Indonesia">
<meta property="og:url" content="https://veenix.online/">
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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body text-center">
          <img src="https://img.pikbest.com/origin/09/18/35/79ApIkbEsT3NC.png!sw800" width="20%">
          <h2>BAGI KALIAN YANG MAU REQUEST FILM, <br />SILAHKAN ISI KOMENTAR DI BAWAH INI :</h2>
          <i class="fa fa-8x fa-arrow-down"></i><br /><br />
          <div id="disqus_thread"></div>
        </div>
      </div>
    </div>
  </div>

</div>


{{-- <div id="uppy">uppy</div> --}}
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
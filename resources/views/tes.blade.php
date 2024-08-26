@extends('visit.app')
@push('css')
<link href="/css/video-js.css" rel="stylesheet" />
<style>
iframe { 
    width: 100%;
    aspect-ratio: 16 / 9;
  }
</style>
@endpush
@section('content')
<div class="container">
  <video
    id="my-video"
    class="video-js"
    controls
    preload="auto"
    width="640"
    height="264"
    poster="MY_VIDEO_POSTER.jpg"
    data-setup="{}"
  >
    <source src="/storage/video/twister.mp4" type="video/mp4" />
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
  </video>
</div>
@endsection

@push('js')
    
  <script src="/js/video.min.js"></script>
@endpush
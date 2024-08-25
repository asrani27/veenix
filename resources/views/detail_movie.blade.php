@extends('visit.app')
@push('css')
    
<style>
  iframe { 
      width: 100%;
      aspect-ratio: 16 / 9;
    }
  </style>
@endpush
@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb float-sm-left" style="background-color:#ffff0003;padding-left:0px">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        @foreach (json_decode($data->genre) as $item)
            
        <li class="breadcrumb-item"><a href="/genre/{{$item}}">{{$item}}</a></li>
        @endforeach
        <li class="breadcrumb-item active">{{$data->title}}</li>
      </ol>
    </div><!-- /.col -->
    
  </div>
  <div class="row">
    <div class="col-lg-12">
          <iframe title="player" scrolling="no" frameborder="0" marginwidth="0" allowfullscreen="yes" src="{{$data->link_video}}" allow="autoplay; fullscreen" style="width: 100%; height: 80%; overflow: hidden;" referrerpolicy="no-referrer-when-downgrade"></iframe>

          {{-- <iframe src="{{$data->link_video}}" frameborder="0" width="100%" height="540px" scrolling="no" allowfullscreen="true" ></iframe> --}}
         
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">LINK DOWNLOAD</h3>

              <div class="card-tools">
                
              </div>
              <!-- /.card-tools -->
            </div>
            <div class="card-body">
              @if ($data->link_download != null)
                <a href="{{$data->link_download}}" class="btn btn-primary" target="_blank"><i class="fas fa-play"></i> DOWNLOAD</a>
              @endif
            </div>
          </div>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-2 text-center">
              <img src="{{$data->image}}" width="185px" height="275px">
            </div>
            <div class="col-sm-7" style="padding-left:25px">
              <h4><strong>{{$data->title}} </strong></h4>
              {{$data->description}}
              <br/><br/>
              <strong>Views: </strong>{{$data->views}}<br/>

              <strong>Genre: </strong>
              @foreach (json_decode($data->genre) as $item)
                  <a href="/genre/{{$item}}">{{$item}}</a>, 
              @endforeach
              <br/>

              <strong>Director: </strong>Taika Waititi<br/>

              <strong>Actors: </strong>Cate Blanchett, Chris Hemsworth, Jeff Goldblum, Karl Urban, Mark Ruffalo, Tessa Thompson, Tom Hiddleston<br/>

              <strong>Country: </strong>USA<br/>
              <strong>Duration: </strong> 170 min<br/>

              <strong>Release: </strong> 2017<br/>

              <strong>IMDb: </strong> N/A<br/>
            </div>
            <div class="col-sm-3 text-center">
              <img src="https://palapanews.com/wp-content/uploads/2018/06/space-iklan.png" width="100%">
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div id="disqus_thread"></div>
        </div>
      </div>
    </div>
  </div>

</div>
    
@endsection

@push('js')

<script>
  /**
  *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
  *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
  /*
  var disqus_config = function () {
  this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
  this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
  };
  */
  (function() { // DON'T EDIT BELOW THIS LINE
  var d = document, s = d.createElement('script');
  s.src = 'https://veenix-online.disqus.com/embed.js';
  s.setAttribute('data-timestamp', +new Date());
  (d.head || d.body).appendChild(s);
  })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endpush
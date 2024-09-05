@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="info-box">
            <span class="">
                <img src="{{$data->image}}" width="150px">
            </span>

            <div class="info-box-content" style="text-align: top">
              <span class="info-box-number">{{$data->title}}</span>
              <span class="">{{$data->description}}</span>

              <span class="">Genre : {{$data->genre}}</span>
              <span class="">Country :{{$data->country}}</span>
              <span class="">Actor : {{$data->actor}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
      </div>
    </div>
    <h5 class="mb-2">Tambahkan Episode Pada Form Di Bawah Ini</h5>
    <form method="post" action="">
        @csrf
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                <label>Season</label>
                <input type="text" name="season" class="form-control" placeholder="1" required onkeypress="return hanyaAngka(event)"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                <label>Episode</label>
                <input type="text" name="episode" class="form-control" placeholder="1" required onkeypress="return hanyaAngka(event)"/>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                <label>Link</label>
                <input type="text" name="url" class="form-control" placeholder="https://www.paris-hostel.biz/eps/worst-ex-ever-s1-eps1/" required>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                <label>action</label>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-12">

            <div class="card">
                <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th class="text-center">Season</th>
                        <th class="text-center">Episode</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Streaming</th>
                        <th class="text-center">Download</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($episode as $item)
                            <tr>
                                <td class="text-center">{{$item->season}}</td>
                                <td class="text-center">{{$item->episode}}</td>
                                <td>{{$item->title}} <br/>
                                  <small>{{$item->description}}</small>
                                </td>
                                <td class="text-center"><a href="{{$item->link_video}}" class="btn btn-primary" target="_blank"><i class="fa fa-play"></i> {{$item->quality}}</a>
                                
                                </td>
                                <td class="text-center">
                                  @if ($item->link_download == null)
                                      -
                                  @else
                                  
                                    @foreach ($item->link_download as $key => $link)
                                    <a href="{{$link}}" class="btn btn-info" target="_blank">{{$key+1}}</a>
                                    @endforeach
                                  @endif
                                </td>
                                <td class="text-center">
                                    <a href="/user/tv/episode/edit/{{$item->id}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                    <a href="/user/tv/episode/delete/{{$item->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                      
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
@endpush
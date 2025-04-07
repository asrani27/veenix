@extends('layouts.app')

@section('content')
<br />
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4">
      <a href="/user/post/add" class="btn btn-primary btn-md">
        <i class="fas fa-plus"></i> Scrapping
      </a>
      <a href="/user/post/create" class="btn btn-primary btn-md">
        <i class="fas fa-plus"></i> tambah
      </a>
    </div>
    <div class="col-lg-8">
      <form method="get" action="/user/post/search">
        @csrf
        <div class="input-group">
          <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="search" required>
          <span class="input-group-append">
            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
    </div>
  </div>
  <br />
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-gradient-secondary">
          <h3 class="card-title">Data Post</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-hover">
            <thead>
              <tr class="bg-gradient-primary">
                <th style="width: 10px">#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Streaming</th>
                <th>Download</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $key=> $item)
              <tr style="font-size: 14px">
                <td>{{$key + $data->firstItem()}}</td>
                <td><img src="{{$item->image}}" width="100px" height="140px"></td>
                <td>{{$item->title}}</td>
                <td>
                  {{$item->description}} <br />
                  <strong>Genres :</strong> {{$item->genre}}<br />
                  <strong>Country :</strong> {{$item->country}}<br />
                  <strong>Actors :</strong> {{$item->actor}}

                </td>
                <td class="text-center"><a href="{{$item->link_video}}" class="btn btn-primary" target="_blank"><i
                      class="fa fa-play"></i> {{$item->quality}}</a></td>
                <td class="text-center">
                  @if ($item->link_download == null)
                  -
                  @else

                  @foreach ($item->link_download as $key => $link)
                  <a href="{{$link}}" class="btn btn-info" target="_blank">{{$key+1}}</a>
                  @endforeach
                  @endif
                </td>
                <td>
                  <a href="/user/post/edit/{{$item->id}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                  <a href="/user/post/delete/{{$item->id}}" class="btn btn-sm btn-danger"
                    onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{$data->links()}}
    </div>
  </div>
</div>
@endsection
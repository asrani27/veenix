@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-4">
        <a href="/user/tv/add" class="btn btn-primary btn-md">
          <i class="fas fa-plus"></i> Scrapping
        </a>
      </div>
      <div class="col-lg-8">
        <form method="get" action="/user/tv/search">
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
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-gradient-secondary">
                  <h3 class="card-title">Data TV Series</h3>
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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=> $item)
                        <tr style="font-size: 14px">
                            <td>{{$key + $data->firstItem()}}</td>
                            <td><img src="{{$item->image}}" width="100px" height="140px"></td>
                            <td>{{$item->title}}
                              <br/><br/>
                              <strong>By : {{$item->username}}</strong>
                            </td>
                            <td>
                              {{$item->description}} <br/>
                              <strong>Genres :</strong> {{$item->genre}}<br/>
                              <strong>Country :</strong> {{$item->country}}<br/>
                              <strong>Actors :</strong> {{$item->actor}}
                              
                            </td>
                            <td>
                              <div class="btn-group">
                              <a href="/user/tv/episode/{{$item->id}}" class="btn btn-sm btn-primary"><i class="fa fa-play"></i> Episode </a>
                              <a href="/user/tv/edit/{{$item->id}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                              <a href="/user/tv/delete/{{$item->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                              </div>
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
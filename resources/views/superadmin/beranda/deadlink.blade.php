@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-gradient-secondary">
                  <h3 class="card-title">Data Deadlink Video</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <form method="get" action="/superadmin/deadlinkvideo/list/search">
                    @csrf
                    <div class="input-group">
                      <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="search" required>
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                  <br/>
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr class="bg-gradient-primary">
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>Link</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=> $item)
                        <tr style="font-size: 14px">
                            <td>{{$key + 1}}</td>
                            <td width="20%">{{$item->title}}</td>
                            <td>
                              <form method="post" action="/superadmin/deadlinkvideo/list/{{$item->id}}">
                                @csrf
                                <textarea class="form-control" rows="3" name="link_video">{{$item->link_video}}</textarea>
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> UPDATE</button>
                              </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
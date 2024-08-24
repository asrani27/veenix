@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
  <a href="/superadmin/user/add" class="btn btn-primary">Add User</a><br/><br/>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-gradient-secondary">
                  <h3 class="card-title">Users</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Ban</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=> $item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->is_aktif}}</td>
                            <td>
                              <a href="/superadmin/user/delete/{{$item->id}}" class="btn btn-sm btn-danger">
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
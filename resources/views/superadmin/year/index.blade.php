@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-gradient-secondary">
                  <h3 class="card-title">Year</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Tahun</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=> $item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->tahun}}</td>
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
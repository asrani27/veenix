@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Logo</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="/superadmin/logo" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Upload Logo</label>
                            <div>
                                <input type="file" name="logo"><br/>
                                <img src="{{$data == null ? null :$data->logo}}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        
                        <div class="form-group">

                            <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <!-- /.input group -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
                    <form method="post" action="/superadmin/logo">
                    @csrf
                        <div class="form-group">
                            <label>Link Logo Cooltext</label>
                            <div>
                            <textarea class="form-control" rows="4" name="logo">{{$data == null ? null :$data->logo}}</textarea>
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
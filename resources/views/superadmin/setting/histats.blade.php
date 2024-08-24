@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Histats</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="/superadmin/histats">
                    @csrf
                        <div class="form-group">
                            <label>Javascript</label>
                            <div>
                            <textarea class="form-control" rows="8" name="histats">{{$data == null ? null :$data->histats}}</textarea>
                            </div>
                            <!-- /.input group -->
                        </div>
                        {!!Histats()!!}
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
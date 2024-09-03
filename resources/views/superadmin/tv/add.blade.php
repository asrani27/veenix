@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add TV Series</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="/superadmin/tv/add">
                    @csrf
                        <div class="form-group">
                            <label>Url:</label>
        
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                            </div>
                            <input type="text" class="form-control" name="url" value="{{old('url')}}" placeholder="https://www.paris-hostel.biz/tv/worst-ex-ever/" required>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <div>
                            <button type="submit" class="btn btn-primary">Scrapping</button>
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
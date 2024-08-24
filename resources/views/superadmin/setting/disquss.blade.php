@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Disquss</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="/superadmin/disquss">
                    @csrf
                        <div class="form-group">
                            <label>Javascript</label>
                            <div>
                            <textarea class="form-control" rows="20" name="disquss">{{$data == null ? null : $data->disquss}}</textarea>
                            </div>
                            <!-- /.input group -->
                        </div>

                          <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>


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
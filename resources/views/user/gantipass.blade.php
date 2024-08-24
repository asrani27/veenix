@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ganti Password</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="/user/gantipassword">
                    @csrf
                        <div class="form-group">
                            <label>New Password</label>
                            <div>
                            <input type="text" class="form-control" name="password" required onkeypress="return event.charCode != 32">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <div>
                            <input type="text" class="form-control" name="confirm_password" required onkeypress="return event.charCode != 32">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
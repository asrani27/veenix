@extends('layouts.app')

@section('content')
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add User</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="/superadmin/user/add">
                    @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" placeholder="nama" required onkeypress="return event.charCode != 32">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="username" placeholder="username" required onkeypress="return event.charCode != 32">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="password" placeholder="password" required onkeypress="return event.charCode != 32">
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
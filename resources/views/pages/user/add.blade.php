@extends('layouts.default')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">User </h4>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Tambah User</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('user/create')}}">
                            @csrf
                            <div class="login-form">
                                <div class="form-group form-floating-label">
                                    <input id="name" name="name" type="text" class="form-control input-border-bottom" required>
                                    <label for="name" class="placeholder">Name</label>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="email" name="email" type="email" class="form-control input-border-bottom" required>
                                    <label for="email" class="placeholder">Email</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="user_role">Tingkatan</label>
                                    <select class="form-control" id="user_role" name="user_role_id">
                                        @foreach ($role as $item)    
                                            <option value="{{$item->user_role_id}}">
                                                {{$item->user_role_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="password" name="password" type="password" class="form-control input-border-bottom" required>
                                    <label for="password" class="placeholder">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="password-confirm" name="password-confirmation" type="password" class="form-control input-border-bottom" required>
                                    <label for="password-confirm" class="placeholder">Confirm Password</label>
                                </div>
                                <div class="form-action">
                                    <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                                    <a href="{{url('user/')}}" class="btn btn-danger">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
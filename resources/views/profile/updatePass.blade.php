@extends('main')

@section('konten')
@include('header')

<div class="container">
    <h1 class="mt-4" style="color: #13315C">Update Password</h1>
    <hr>
    <div class="row">
        <!-- left column -->
        <div class="col-md-3">
            <div class="text-center">
                <div class="user-profile">
                    <div class="user-avatar">
                        <img src="{{ asset('ppp.jpg') }}" alt="profile" width="100" height="100" class="rounded-circle">
                    </div>
                    <h5 class="user-name mt-4">{{ $user->nama }}</h5>
                    <h6 class="user-email">{{ $user->email }}</h6>
                </div>
            </div>
        </div>

        <!-- edit form column -->
        <div class="col-md-9 personal-info" >
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ route('pass.update') }}">
                @csrf
                @method('PUT')
                <div class="form-group mt-3">
                    <label class="col-md-3 control-label">Old Password</label>
                    <div class="col-md-8">
                        <input class="form-control" type="password" type="old_password" name="old_password">
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label class="col-md-3 control-label">New password</label>
                    <div class="col-md-8">
                        <input class="form-control" type="password" name="new_password">
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label class="col-md-3 control-label">Confirm password</label>
                    <div class="col-md-8">
                        <input class="form-control" type="password" name="confirm_password">
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

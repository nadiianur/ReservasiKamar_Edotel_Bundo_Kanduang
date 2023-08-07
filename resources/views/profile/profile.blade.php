@extends('main')

@section('konten')
@include('header')

<div class="container">
    <h1 class="mt-4" style="color: #13315C">My Profile</h1>
    <hr>
    <div class="row m-auto">
        <!-- left column -->
        <div class="col-md-3">
            <div class="text-center">
                <div class="user-profile">
                    <div class="user-avatar">
                        <img src="{{ asset('ppp.jpg') }}" alt="profile" width="100" height="100" class="rounded-circle">
                    </div>
                    <h5 class="user-name mt-4">{{ $user->nama }}</h5>
                    <h6 class="user-email">{{ $user->email }}</h6>
                    <div class="about">
                        <h5 class="mt-5" style="color: blue; font-weight:400">About</h5>
                        <p>{{ $user->nama }} is a loyalty customer stayscape.</p>
                    </div>
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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="col-lg-3 control-label fw-semibold">Nama</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="{{ $user->nama }}" name="nama">
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label class="col-lg-3 control-label fw-semibold">Email</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="{{ $user->email }}" name="email">
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label class="col-lg-3 control-label fw-semibold">No HP</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="{{ $user->no_hp }}" name="no_hp">
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label class="col-lg-3 control-label fw-semibold">Jenis Kelamin</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="{{ $user->jenis_kelamin }}" name="jenis_kelamin">
                    </div>
                </div>
                <div class="form-group mt-3">
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

@extends('main')

@section('konten')
@include('header')

<style>
    .button {
        border-radius: 25px;
        width: 190px;
        height: 35px;
        font-weight: bold;
        font-size: 15px
    }
</style>

<div class="container">
    <h3 class="mb-3 mt-4" style="color: #13315C; text-align:center">Daftar Customer Stayscape</h3>

    {{-- menampilkan alert msg --}}
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

    {{-- Add Customer --}}
    <button type="button" class="button btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahCustomer">
        + New Customer
    </button>
    <!-- Modal Add-->
    <div class="modal fade" id="modalTambahCustomer" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('customer.add') }}" id="addCustomerForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="inputNama" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputNama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="inputNoHp" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="inputNoHp" name="no_hp">
                        </div>
                        <div class="mb-3">
                            <label for="tipe-kamar">Gender</label>
                            <select class="form-select" id="jenis-kelamin" aria-label="Default select example"
                                name="jenis_kelamin">
                                <option selected>Pilih</option>
                                <option value="perempuan">Perempuan</option>
                                <option value="laki-laki">Laki-laki</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add Customer --}}

    {{-- Menampilkan Data Customer --}}
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $u)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $u->nama }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->no_hp }}</td>
                <td>{{ $u->jenis_kelamin }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- End Menampilkan Data Customer --}}
</div>

@endsection

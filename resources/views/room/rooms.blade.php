@extends('main')

@section('konten')
@include('header')

<style>
    .button {
        border-radius: 25px;
        width: 180px;
        height: 35px;
        font-weight: bold;
        font-size: 15px
    }
</style>

<ul class="nav nav-tabs justify-content-center">
    <li class="nav-item">
      <a class="nav-link mx-3"  href="/katalogRooms">Katalog Rooms</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active mx-3" aria-current="page" href="/rooms">List Rooms</a>
    </li>
</ul>

<div class="container">
    <h3 class="mb-3 mt-4" style="color: #13315C; text-align:center">Daftar Rooms Stayscape</h3>

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

    {{-- Add Room --}}
    <button type="button" class="button btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahRoom">
        + New Room
    </button>
    <!-- Modal Add-->
    <div class="modal fade" id="modalTambahRoom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Room</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('rooms.add') }}" id="addRoomForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="inputNoRoom" class="form-label">Number of Room</label>
                            <input type="number" class="form-control" id="inputNoRoom" name="no_kamar">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="tipe-kamar">Type of Room</label>
                            <select class="form-select" id="tipe-kamar" aria-label="Default select example"
                                name="tipe_kamar">
                                <option selected>Pilih</option>
                                <option value="single room">Single room</option>
                                <option value="double room">Double room</option>
                                <option value="family room">Family room</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputHarga" class="form-label">Price /night</label>
                            <input type="number" class="form-control" id="inputHarga" name="harga">
                        </div>
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" aria-label="Default select example" name="status">
                                <option selected>Pilih</option>
                                <option value="ready">Ready</option>
                                <option value="not ready">Not Ready</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputKapasitas" class="form-label">Max Capacity of Room</label>
                            <input type="number" class="form-control" id="inputKapasitas" name="kapasitas">
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
    {{-- End Add Room --}}


    {{-- Menampilkan data room --}}
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Number of Room</th>
                <th>Room Type</th>
                <th>Price /night</th>
                <th>Status</th>
                <th>Capacity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>Room {{ $room->no_kamar }}</td>
                <td>{{ $room->tipe_kamar }}</td>
                <td>IDR {{ $room->harga }}</td>
                <td>{{ $room->status }}</td>
                <td>{{ $room->kapasitas }} person</td>
                <td>
                    {{-- Edit Transaksi --}}
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#modalEditRoom{{ $room->id_kamar }}">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    <!-- Modal Edit-->
                    <div class="modal fade" id="modalEditRoom{{ $room->id_kamar }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Room</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('rooms.update', $room->id_kamar) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="editNoRoom" class="form-label">Number of Room</label>
                                            <input type="number" class="form-control" id="editNoRoom" name="no_kamar"
                                                value="{{ $room->no_kamar }}">
                                            @error('no_kamar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="editTipeKamar">Type of Room</label>
                                            <select class="form-select" id="editTipeKamar" name="tipe_kamar">
                                                <option value="single room"
                                                    {{ $room->tipe_kamar == 'single room' ? 'selected' : '' }}>Single
                                                    room</option>
                                                <option value="double room"
                                                    {{ $room->tipe_kamar == 'double room' ? 'selected' : '' }}>Double
                                                    room</option>
                                                <option value="family room"
                                                    {{ $room->tipe_kamar == 'family room' ? 'selected' : '' }}>Family
                                                    room</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editHarga" class="form-label">Price /night</label>
                                            <input type="number" class="form-control" id="editHarga" name="harga"
                                                value="{{ $room->harga }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editStatus">Status</label>
                                            <select class="form-select" id="editStatus" name="status">
                                                <option value="ready" {{ $room->status == 'ready' ? 'selected' : '' }}>
                                                    Ready</option>
                                                <option value="not ready" {{ $room->status == 'not ready' ? 'selected' : '' }}>
                                                    Not Ready</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editKapasitas" class="form-label">Capacity of Room</label>
                                            <input type="number" class="form-control" id="editKapasitas"
                                                name="kapasitas" value="{{ $room->kapasitas }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Edit Transaksi --}}


                    {{-- Delete Transaksi --}}
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modalHapusData{{$room->id_kamar}}">
                        <i class="bi bi-trash"></i>
                    </button>
                    <!-- Modal Delete-->
                    <div class="modal fade" id="modalHapusData{{$room->id_kamar}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Yakin ingin menghapus room ini ?
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('rooms.destroy', $room->id_kamar) }}" method="POST"
                                        class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Delete Transaksi --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- End menampilkan data room --}}
</div>


@endsection

@extends('main')

@section('konten')

@include('header')

<div class="container">
    @if(Auth::user()->role == 'admin')
    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link active mx-3" aria-current="page" href="/katalogRooms">Katalog Rooms</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mx-3" href="/rooms">List Rooms</a>
        </li>
    </ul>
    @endif

    <h3 class="mb-3 mt-4" style="color: #13315C; text-align:center">Rooms Stayscape</h3>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row" style="margin-block: 5vh;">
        @foreach($rooms as $room)
        <div class="col-sm-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <!-- Tampilkan data sesuai kebutuhan -->
                    <h5 class="text-center" style="font-weight: 700; color: #8DA9C4">Detail Room</h5>
                    <hr>
                    <p class="card-text fw-semibold" style="color: #13315C"> The room is
                        '{{ strtoupper($room->status) }}' </p>
                    <p class="card-text fw-semibold"><i class="bi bi-wifi"></i> Free Wifi</p>
                    <p class="card-text fw-semibold"> <i class="bi bi-moon"></i> In room {{ $room->no_kamar }} </p>
                    <p class="card-text fw-semibold"><i class="bi bi-bookmark-heart"></i> Type : {{ $room->tipe_kamar }}
                    </p>
                    <p class="card-text fw-semibold"><i class="bi bi-person-fill"></i></i> Max : {{ $room->kapasitas }}
                        person </p>
                    <p class="card-text fw-bold" style="font-size: 22px; color:blue; text-align: right">IDR
                        {{ $room->harga }} </p>
                    <p class="card-text fw-normal" style="font-size: 12px; text-align: right">/room/night</p>
                    <br>

                    {{-- Jika Role User Customer --}}
                    @if(Auth::user()->role == 'customer')
                    @if ($room->status == 'not ready')
                    <button type="button" class="d-grid gap-2 col-6 d-md-block btn btn-secondary mx-auto" disabled>
                        <p class="card-text fw-semibold"> Booking </p>
                    </button>
                    @else
                    <a href="{{ route('booking.showStore', $room->id_kamar) }}" type="button"
                        class="d-grid gap-2  col-6 d-md-block btn btn-primary mx-auto">
                        <p class="card-text fw-semibold"> Booking </p>
                    </a>
                    @endif
                    @endif

                    {{-- Jika Role User Admin --}}
                    @if(Auth::user()->role == 'admin')
                    <button type="button" class="d-grid gap-2  col-6 d-md-block btn btn-warning mx-auto"
                        data-bs-toggle="modal" data-bs-target="#modalEditRoom{{ $room->id_kamar }}">
                        <p class="card-text fw-semibold"><i class="bi bi-pencil-fill"></i>Edit </p>
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
                                                <option value="not ready"
                                                    {{ $room->status == 'not ready' ? 'selected' : '' }}>
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
                    @endif
                    {{-- End Role User Admin --}}
                    <br>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @endsection

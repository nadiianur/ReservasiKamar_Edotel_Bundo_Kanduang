@extends('main')

@section('konten')
@include('header')

<div class="container">
    <h3 class="mb-3 mt-4" style="color: #13315C; text-align:center">Daftar Transactions Stayscape</h3>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Number of Room</th>
                <th>Type of Room</th>
                <th>Check In At</th>
                <th>Check Out At</th>
                <th>Length of Stay</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $tr)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$tr->user->nama }}</td>
                <td>Room {{ $tr->kamar->no_kamar }}</td>
                <td>{{ $tr->kamar->tipe_kamar }}</td>
                <td>{{ $tr->check_in_at }}</td>
                <td>{{ $tr->check_out_at }}</td>
                <td>{{ $tr->lama_penginapan }} day</td>
                <td>IDR {{ $tr->total_harga }}</td>
                <td>{{ $tr->status }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalVerify{{ $tr->id_transaksi }}">
                        Verify
                    </button>

                    <!-- Modal Verify-->
                    <div class="modal fade" id="modalVerify{{  $tr->id_transaksi }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Verify Status Customer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('transactions.verify', $tr->id_transaksi) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="editTipeKamar">Status</label>
                                            <select class="form-select" id="verify" name="status">
                                                <option value="booking"
                                                    {{ $tr->status == 'booking' ? 'selected' : '' }}>Booking</option>
                                                <option value="verified"
                                                    {{ $tr->status == 'verified' ? 'selected' : '' }}>Verified</option>
                                                <option value="check in"
                                                    {{ $tr->status == 'check in' ? 'selected' : '' }}>Check In</option>
                                                <option value="check out"
                                                    {{ $tr->status == 'check out' ? 'selected' : '' }}>Check Out
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Verify</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Verify-->

                    {{-- <a href="{{ route('rooms.edit', $room->id_kamar) }}" class="btn btn-warning">Edit</a> --}}

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modalHapusData{{$tr->id_transaksi}}">
                        Delete
                    </button>

                    <!-- Modal Delete-->
                    <div class="modal fade" id="modalHapusData{{$tr->id_transaksi}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Yakin ingin menghapus transaksi
                                        ini ?
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('transactions.destroy', $tr->id_transaksi) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Delete-->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

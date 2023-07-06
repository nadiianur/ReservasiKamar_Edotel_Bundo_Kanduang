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
    <h3 class="mb-3 mt-4" style="color: #13315C; text-align:center">Daftar Transactions Stayscape</h3>

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

    {{-- Add Transaksi --}}
    <button type="button" class="button btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahTransaksi">
        + New Transaction
    </button>
    <!-- Modal Add-->
    <div class="modal fade" id="modalTambahTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Transaction Booking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('transaction.storeByAdmin') }}" id="addTransaksiForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Customer</label>
                            <select class="form-select" id="nama" aria-label="Default select example" name="nama"
                                required>
                                <option selected>Pilih</option>
                                @foreach ($user as $u)
                                <option value="{{ $u->id_user }}">{{ $u->id_user }} | {{ $u->nama }} - {{ $u->email }}
                                </option>
                                @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label"></label>
                            <input type="hidden">
                        </div>
                        <div class="mb-3">
                            <label for="no_kamar" class="form-label">Room</label>
                            <select class="form-select" id="no_kamar" aria-label="Default select example"
                                name="no_kamar" required>
                                <option selected>Pilih</option>
                                @foreach ($kamar as $r)
                                @if ($r->status == 'ready')
                                <option value="{{ $r->id_kamar }}">{{ $r->no_kamar }} | {{ $r->tipe_kamar }} - IDR
                                    {{ $r->harga }}</option>
                                @endif
                                @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label"></label>
                            <input type="hidden">
                        </div>
                        <div class="mb-4">
                            <label for="inputHarga" class="form-label">Time Check In</label>
                            <input type="datetime-local" class="datetime"
                                style="margin-left: 50px; border-radius:8px; width: 250px" name="check_in_at" required>
                        </div>
                        <div class="mb-5">
                            <label for="inputHarga" class="form-label">Time Check Out</label>
                            <input type="datetime-local" class="datetime"
                                style="margin-left: 37px; border-radius:8px; width: 250px" name="check_out_at" required>
                        </div>
                        <hr>
                        <p class="fw-semibold" style="color: #13315C">Payment is made offline at StayScape reception, proceed to confirm customer payment.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add Transaksi --}}


    {{-- Menampilkan data transaksi --}}
    <br><br>
    <table class="table" >
        <thead>
            <tr style="text-align: center;">
                <th>No</th>
                <th>Nama</th>
                <th>Number Room</th>
                <th>Type Room</th>
                <th>Check In At</th>
                <th>Check Out At</th>
                <th>Length of Stay</th>
                <th>Total Price</th>
                <th>Payment</th>
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

                @if ($tr->pembayaran == 'paid')
                <td style="color:green">Paid</td>
                @elseif ($tr->pembayaran == 'unpaid')
                <td style="color:red">Unpaid</td>
                @endif

                @if ( $tr->status == 'booking')
                <td style="color: #00c6ee">Booking</td>
                @elseif (( $tr->status == 'verified'))
                <td style="color:blue">Verified</td>
                @elseif (( $tr->status == 'check in'))
                <td style="color:limegreen">Check In</td>
                @elseif (( $tr->status == 'check out'))
                <td style="color:brown">Check Out</td>
                @endif

                <td>
                    {{-- Verify Status Transaksi --}}
                    @if ($tr->status === 'check out')
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#modalVerify{{ $tr->id_transaksi }}" disabled>
                        <i class="bi bi-check2-circle"></i>
                    </button>
                    @else
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#modalVerify{{ $tr->id_transaksi }}">
                        <i class="bi bi-check2-circle"></i>
                    </button>
                    @endif

                    <!-- Modal Verify-->
                    <div class="modal fade" id="modalVerify{{  $tr->id_transaksi }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Verify Status Transaction</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('transactions.verify', $tr->id_transaksi) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        @if ($tr->status === 'booking' && $tr->pembayaran === 'paid')
                                        <div class="mb-3">
                                            <label for="editTipeKamar">Status</label>
                                            <select class="form-select" id="verify" name="status">
                                                <option selected>Pilih</option>
                                                <option value="verified"
                                                    {{ $tr->status == 'verified' ? 'selected' : '' }}>Verified</option>
                                            </select>
                                        </div>
                                        @elseif ($tr->status ==='verified' && $tr->pembayaran === 'paid')
                                        <div class="mb-3">
                                            <label for="editTipeKamar">Status</label>
                                            <select class="form-select" id="verify" name="status">
                                                <option selected>Pilih</option>
                                                <option value="check in"
                                                    {{ $tr->status == 'check in' ? 'selected' : '' }}>Check In</option>
                                            </select>
                                        </div>
                                        @elseif ($tr->status === 'booking' && $tr->pembayaran === 'unpaid')
                                        <div class="mb-3">
                                            <p class="fw-semibold" style="color: #13315C">Payment is made offline at StayScape reception, proceed to confirm customer payment.</p>
                                            <hr>
                                            <p class="fw-normal">Change status transaction </p>
                                            <label for="editTipeKamar">Status</label>
                                            <select class="form-select" id="verify" name="status">
                                                <option selected>Pilih</option>
                                                <option value="verified"
                                                    {{ $tr->status == 'verified' ? 'selected' : '' }}>Verified</option>
                                            </select>
                                        </div>
                                        @else
                                        <div class="mb-3">
                                            <label for="editTipeKamar">Status</label>
                                            <select class="form-select" id="verify" name="status">
                                                <option selected>Pilih</option>
                                                <option value="check out"
                                                    {{ $tr->status == 'check out' ? 'selected' : '' }}>Check Out
                                                </option>
                                            </select>
                                        </div>
                                        @endif
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
                    {{-- End Verify Status Transaksi --}}


                    {{-- Edit Transaksi --}}
                    @if ($tr->status === 'check out')
                    <button type="button" class="btn btn-secondary" disabled>
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    @else
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#modalEditTransaksi{{ $tr->id_transaksi }}">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    <!-- Modal Edit-->
                    <div class="modal fade" id="modalEditTransaksi{{ $tr->id_transaksi }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data Transaction
                                        Booking
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('booking.update',$tr->id_transaksi) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        @if ($tr->status === 'check in' || $tr->status === 'check out' )
                                        <div class="mb-3">
                                            <label for="no_kamar" class="form-label">Room</label>
                                            <select class="form-select" id="no_kamar"
                                                aria-label="Default select example" name="no_kamar" required disabled>
                                                <option selected>{{ $tr->kamar->no_kamar}} | {{ $tr->kamar->tipe_kamar}}
                                                    - IDR {{ $tr->kamar->harga}}</option>
                                                @foreach ($kamar as $r)
                                                @if ($r->status == 'ready')
                                                <option value="{{ $r->id_kamar }}">{{ $r->no_kamar }} |
                                                    {{ $r->tipe_kamar }} - IDR
                                                    {{ $r->harga }}</option>
                                                @endif
                                                @endforeach
                                        </div>
                                        @else
                                        <div class="mb-3">
                                            <label for="no_kamar" class="form-label">Room</label>
                                            <select class="form-select" id="no_kamar"
                                                aria-label="Default select example" name="no_kamar" required>
                                                <option selected>{{ $tr->kamar->no_kamar}} | {{ $tr->kamar->tipe_kamar}}
                                                    - IDR {{ $tr->kamar->harga}}</option>
                                                @foreach ($kamar as $r)
                                                @if ($r->status == 'ready')
                                                <option value="{{ $r->id_kamar }}">{{ $r->no_kamar }} |
                                                    {{ $r->tipe_kamar }} - IDR
                                                    {{ $r->harga }}</option>
                                                @endif
                                                @endforeach
                                        </div>
                                        @endif
                                        <div class="mb-3">
                                            <label for="" class="form-label"></label>
                                            <input type="hidden">
                                        </div>
                                        <div class="mb-4">
                                            <label for="inputHarga" class="form-label">Time Check In</label>
                                            <input type="datetime-local" class="datetime"
                                                style="margin-left: 50px; border-radius:8px; width: 250px"
                                                name="check_in_at" value="{{ $tr->check_in_at }}" required>
                                        </div>
                                        <div class="mb-5">
                                            <label for="inputHarga" class="form-label">Time Check Out</label>
                                            <input type="datetime-local" class="datetime"
                                                style="margin-left: 37px; border-radius:8px; width: 250px"
                                                name="check_out_at" value="{{ $tr->check_out_at }}" required>
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
                    {{-- End Edit Transaksi --}}


                    {{-- Delete Transaksi --}}
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modalHapusData{{$tr->id_transaksi}}">
                        <i class="bi bi-trash3"></i>
                    </button>
                    <!-- Modal Delete-->
                    <div class="modal fade" id="modalHapusData{{$tr->id_transaksi}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Yakin ingin menghapus
                                        transaksi
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
                </td>
            </tr>
            @endforeach
            {{-- End Delete Transaksi --}}
        </tbody>
    </table>
    {{-- End Menampilkan data transaksi --}}
</div>

@endsection

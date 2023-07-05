@extends('main')

@section('konten')
@include('header')

<div class="container">
    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link active mx-3" aria-current="page" href="/booking">Verify Transaction</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mx-3" href="/riwayatBooking">Riwayat Transactions</a>
        </li>
    </ul>

    <h2 class="mt-4" style="font-weight:normal; color: #13315C; margin-left: 147px">Please Review Your Transaction</h2>
    <h5 class="mt-3 mb-4" style="margin-left: 147px">Data Transaction</h5>

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

    @foreach ($transactions as $tr)
    <div class="container card mb-5 mt-3" style="width: 1000px">
        <div class="card-body">
            <table class="container">
                <tr>
                    <td>
                        <p class="m-auto fw-bold" style="color:saddlebrown">ID Transaksi : {{ $tr->id_transaksi }}
                        </p>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                            style="position: absolute; top: 10px; right: 25px"
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
                                            transaksi ini ?
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('transactions.destroy', $tr->id_transaksi) }}"
                                            method="POST" class="d-inline">
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
            </table>
            <hr>
            <p class="mt-3" style="font-weight:700; font-size: 18px">Stayscape Booking</p>
            <table class="mt-4">
                <tr style="font-weight:600">
                    <td>Check-In</td>
                    <td style="padding-left:150px">Check-Out</td>
                    <td style="padding-left:150px">Duration</td>
                </tr>
                <tr>
                    <td class="fw-light">{{ strftime('%a, %e %B %Y at %H:%M:%S', strtotime($tr->check_in_at)) }}
                    </td>
                    <td class="fw-light" style="padding-left:150px">
                        {{ strftime('%a, %e %B %Y at %H:%M:%S', strtotime($tr->check_out_at)) }}</td>
                    <td class="fw-light" style="padding-left:150px">{{ $tr->lama_penginapan }} Night</td>
                </tr>
            </table>
            <br>
            <table>
                <tr style="font-weight:600">
                    <td>Customer Name</td>
                </tr>
                <tr>
                    <td class="fw-light">{{ $tr->user->nama}}</td>
                </tr>
            </table>

            {{-- Detail kamar --}}
            <hr style="border-width: 3px" class="mt-5">
            <p class="mt-3" style="font-weight:700; font-size: 18px">Detail Room</p>
            <table>
                <tr>
                    <td>Number of Room</td>
                    <td class="fw-light" style="padding-left:100px">{{ $tr->kamar->no_kamar}}</td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td class="fw-light" style="padding-left:100px">{{ $tr->kamar->tipe_kamar}}</td>
                </tr>
                <tr>
                    <td>Max Capacity</td>
                    <td class="fw-light" style="padding-left:100px">{{ $tr->kamar->kapasitas}} person</td>
                </tr>
                <tr>
                    <td>Price /night</td>
                    <td class="fw-light" style="padding-left:100px">IDR {{ $tr->kamar->harga}}</td>
                </tr>
            </table>

            <hr style="border-width: 3px" class="mt-5">
            <p class="mt-3" style="font-weight:700; font-size: 18px">Cancellation Policy</p>
            <p>At StayScape Accommodation, we understand that sometimes plans change and it may be necessary to
                cancel a
                booking. Please carefully review our cancellation policy below:</p>
            <ol>
                <li>Cancellation made more than 72 hours prior to the scheduled check-in date: You will receive a
                    full
                    refund of the booking amount.</li>
                <li>Cancellation made between 24 to 72 hours prior to the scheduled check-in date: A cancellation
                    fee
                    equivalent to one night's stay will be charged, and the remaining amount will be refunded.</li>
                <li>Cancellation made less than 24 hours prior to the scheduled check-in date or in case of a
                    no-show:
                    No refund will be provided.</li>
            </ol>

            {{-- Detail total harga --}}
            <hr style="border-width: 3px" class="mt-5">
            <p class="mt-3" style="font-weight:700; font-size: 18px">Detail Price</p>
            <table>
                <tr>
                    <td>Stayscape Room number {{ $tr->kamar->no_kamar }}, Type {{ $tr->kamar->tipe_kamar }}
                        X{{ $tr->lama_penginapan }}</td>
                    <td class="fw-light" style="padding-left:100px">IDR {{ $tr->total_harga}}</td>
                </tr>
            </table>

            {{-- Button edit --}}
            <hr style="border-width: 3px" class="mt-5">
            <div class="d-flex justify-content-center">
                @if ($tr->status === 'filled')
                <button type="button" class="btn btn-warning mx-3" data-bs-toggle="modal"
                    data-bs-target="#modalEditTransaksi{{ $tr->id_transaksi }}">
                    <i class="bi bi-pencil-fill"></i> Edit
                </button>
                @else
                <button type="button" class="btn btn-secondary mx-3" data-bs-toggle="modal"
                    data-bs-target="#modalEditTransaksi{{ $tr->id_transaksi }}" disabled>
                    <i class="bi bi-pencil-fill"></i> Edit
                </button>
                @endif
                <!-- Modal Edit-->
                <div class="modal fade" id="modalEditTransaksi{{ $tr->id_transaksi }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data Transaction Booking
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('booking.update',$tr->id_transaksi) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="no_kamar" class="form-label">Room</label>
                                        <select class="form-select" id="no_kamar" aria-label="Default select example"
                                            name="no_kamar" required>
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
                {{-- End button edit --}}

                {{-- Button verify dan pembayaran booking --}}
                @if ($tr->status === 'filled')
                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal"
                    data-bs-target="#modalVerifyStatus{{ $tr->id_transaksi }}">
                    <i class="bi bi-arrow-bar-right"></i> Verify Booking
                </button>
                @else
                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal"
                    data-bs-target="#modalVerifyStatus{{ $tr->id_transaksi }}" disabled>
                    <i class="bi bi-arrow-bar-right"></i> Verify Booking
                </button>
                @endif
                <!-- Modal Verify Status-->
                <div class="modal fade" id="modalVerifyStatus{{ $tr->id_transaksi }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"> Verify Booking
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('booking.verify', $tr->id_transaksi) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <label class="fw-semibold" for="pembayaran">Payment</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="paid" id="paidCheckbox{{ $tr->id_transaksi }}" name="pembayaran[]">
                                        <label class="form-check-label" for="paidCheckbox{{ $tr->id_transaksi }}">Transfer Bank/E-money</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="unpaid" id="unpaidCheckbox{{ $tr->id_transaksi }}" name="pembayaran[]">
                                        <label class="form-check-label" for="unpaidCheckbox{{ $tr->id_transaksi }}">Offline</label>
                                    </div>
                                    <p class="mt-4 fw-semibold">With the mentioned policy terms, do you agree to proceed
                                        with this Payment Transaction?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                <button type="submit" class="btn btn-success">Verify</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End button verify dan pembayaran booking --}}
            </div>
        </div>
    </div>
    @endforeach
</div>


@endsection

@extends('main')

@section('konten')
@include('header')

<div style="margin-left: 134px">
    <h2 class="mt-4" style="font-weight:normal; color: #13315C;">Please Review Your Transaction</h2>
    <h5 class="mt-3 mb-4">Data Transaction</h5>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @foreach ($transactions as $tr)
    <div class="card mb-5 mt-3" style="width: 1000px">
        <div class="card-body">
            <table>
                <tr>
                    <td>
                        <p class="m-auto fw-bold" style="color:saddlebrown">ID Transaksi : {{ $tr->id_transaksi }}</p>
                    </td>
                    <td>
                        @if ($tr->status === 'filled')
                        <button type="button" class="btn btn-danger " data-bs-toggle="modal" style="margin-left: 780px"
                            data-bs-target="#modalHapusData{{$tr->id_transaksi}}">
                            <i class="bi bi-trash3"></i>
                        </button>
                        @else
                        <a href="{{ route('cetak.bukti.transaksi', $tr->id_transaksi) }}"
                            style="margin-left: 780px; "><i class="bi bi-download" style="font-size: 20px;"></i></a>
                        @endif

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
                    <td style="padding-left:200px">Check-Out</td>
                    <td style="padding-left:200px">Duration</td>
                </tr>
                <tr>
                    <td class="fw-light">{{ strftime('%a, %e %B %Y at %H:%M:%S', strtotime($tr->check_in_at)) }}</td>
                    <td class="fw-light" style="padding-left:200px">
                        {{ strftime('%a, %e %B %Y at %H:%M:%S', strtotime($tr->check_out_at)) }}</td>
                    <td class="fw-light" style="padding-left:200px">{{ $tr->lama_penginapan }} Night</td>
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
            <p>At StayScape Accommodation, we understand that sometimes plans change and it may be necessary to cancel a
                booking. Please carefully review our cancellation policy below:</p>
            <ol>
                <li>Cancellation made more than 72 hours prior to the scheduled check-in date: You will receive a full
                    refund of the booking amount.</li>
                <li>Cancellation made between 24 to 72 hours prior to the scheduled check-in date: A cancellation fee
                    equivalent to one night's stay will be charged, and the remaining amount will be refunded.</li>
                <li>Cancellation made less than 24 hours prior to the scheduled check-in date or in case of a no-show:
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

            {{-- Button edit dan verify booking --}}
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
                <!-- End Modal Edit-->

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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Dengan ketentuan kebijakan yang
                                    telah di sebutkan, apakah anda setuju untuk melanjutkan Transaksi Booking ini?
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('booking.verify', $tr->id_transaksi) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Verify Status -->

            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

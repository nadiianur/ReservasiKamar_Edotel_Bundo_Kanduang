@extends('main')

@section('konten')
@include('header')

<div class="container">
    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link" href="/booking">Verify Booking</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active mx-3" aria-current="page" href="/riwayatBooking">Riwayat Booking</a>
        </li>
    </ul>

    <h3 class="mb-3 mt-4" style="color: #13315C; text-align:center">List My Transactions</h3>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    @foreach ($transactions as $tr)
    <div class="container card mb-5 mt-5" style="width: 1000px">
        <div class="card-body">
            <table class="container">
                <tr>
                    <td>
                        <p class="m-auto fw-bold">{{ $loop->iteration }}.
                        </p>
                    </td>
                    <td>
                        <a href="{{ route('cetak.bukti.transaksi', $tr->id_transaksi) }}">
                            <i class="bi bi-download"
                                style="position: absolute; top: 15px; right: 35px;font-size: 20px;"></i>
                        </a>
                    </td>
            </table>
            <hr>
            <p class="m-auto" style="font-weight:700; font-size: 18px; color:saddlebrown">ID Transaksi : {{ $tr->id_transaksi }}
            </p>
            <p class="mt-3" style="font-weight:700; font-size: 18px">Detail Booking</p>
            <table class="mt-4" >
                <tr style="font-weight:600">
                    <td>Check-In</td>
                    <td style="padding-left:120px">Check-Out</td>
                    <td style="padding-left:120px">Duration</td>
                    <td style="padding-left:120px">Status</td>
                </tr>
                <tr>
                    <td class="fw-light">{{ strftime('%a, %e %B %Y at %H:%M:%S', strtotime($tr->check_in_at)) }}
                    </td>
                    <td class="fw-light" style="padding-left:120px;">
                        {{ strftime('%a, %e %B %Y at %H:%M:%S', strtotime($tr->check_out_at)) }}</td>
                    <td class="fw-light" style="padding-left:120px">{{ $tr->lama_penginapan }} Night</td>
                    <td class="fw-light" style="padding-left:120px">{{ $tr->status }}</td>
                </tr>
                <tr style="font-weight:600;">
                    <td style="padding-top: 25px;">Number of Room</td>
                    <td style="padding-left:120px; padding-top: 25px;">Max Capacity</td>
                    <td style="padding-left:120px; padding-top: 25px;">Type</td>
                    <td style="padding-left:120px; padding-top: 25px;">Price /night</td>
                </tr>
                <tr>
                    <td class="fw-light">{{ $tr->kamar->no_kamar}}</td>
                    <td class="fw-light" style="padding-left:120px">{{ $tr->kamar->kapasitas}} person</td>
                    <td class="fw-light" style="padding-left:120px">{{ $tr->kamar->tipe_kamar}}</td>
                    <td class="fw-light" style="padding-left:120px">IDR {{ $tr->kamar->harga}}</td>
                </tr>
            </table>

            {{-- Detail kamar --}}
            <table class="mt-4">

            </table>

            {{-- Detail total harga --}}
            <div class="mt-5" style="float: right">
            <table>
                <tr>
                    <h4 style="padding-left:10px ;font-weight:700; font-size: 18px;">IDR {{ $tr->total_harga}}</h4>
                </tr>
                <tr>
                    <h3 style="text-align: right; color:green; font-weight:600">#{{ $tr->pembayaran }}</h3>
                </tr>
            </table>
        </div>
        </div>
    </div>
    @endforeach
</div>


@endsection

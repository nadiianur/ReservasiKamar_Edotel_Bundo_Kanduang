@extends('main')

@section('konten')
@include('header')

<div style="margin-left: 134px">
    <h2 class="mt-4" style="font-weight:normal; color: #13315C;">Please Review Your Transaction</h2>
    <h5 class="mt-3 mb-4">Data Transaction</h5>
    @foreach ($transactions as $tr)
    <div class="card mb-4 mt-3" style="width: 1000px">
        <div class="card-body">
            <p>ID Transaksi : {{ $tr->id_transaksi }}</p>
            <hr>
            <h5 style="font-size:18px; font-weight:400">Stayscape Room</h5>
            <table class="mt-4">
                <tr style="font-weight:600">
                    <td>Check-In</td>
                    <td style="padding-left:200px">Check-Out</td>
                    <td style="padding-left:200px">Duration</td>
                </tr>
                <tr>
                    <td>{{ strftime('%a, %e %B %Y at %H:%M:%S', strtotime($tr->check_in_at)) }}</td>
                    <td style="padding-left:200px">{{ strftime('%a, %e %B %Y at %H:%M:%S', strtotime($tr->check_out_at)) }}</td>
                    <td style="padding-left:200px">{{ $tr->lama_penginapan }} Night</td>
                </tr>
            </table>
            <p class="mt-4" style="font-weight:600">Customer Name</p>
            <p class="mb-4">{{ $tr->user->nama}}</p>

            {{-- Detail kamar --}}
            <hr style="border-width: 3px">
            <p class="mt-3" style="font-weight:600">Detail Room</p>
            <table>
                <tr>
                    <td>Number of Room</td>
                    <td style="padding-left:100px">{{ $tr->kamar->no_kamar}}</td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td style="padding-left:100px">{{ $tr->kamar->tipe_kamar}}</td>
                </tr>
                <tr>
                    <td>Max Capacity</td>
                    <td style="padding-left:100px">{{ $tr->kamar->kapasitas}} person</td>
                </tr>
            </table>

            {{-- Detail total harga --}}
            <hr style="border-width: 3px">
            <p class="mt-3" style="font-weight:600">Detail Price</p>
            <table>
                <tr>
                    <td>Stayscape Room number {{ $tr->kamar->no_kamar }}, Type {{ $tr->kamar->tipe_kamar }} X{{ $tr->lama_penginapan }}</td>
                    <td style="padding-left:100px">IDR {{ $tr->total_harga}}</td>
                </tr>
            </table>
        </div>
    </div>
    @endforeach
</div>

@endsection

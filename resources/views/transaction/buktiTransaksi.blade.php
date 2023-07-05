<!DOCTYPE html>
<html>

<head>
    <title>Stayscape Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid #000;
        }

    </style>
</head>

<body>
    <img src="{{ public_path('logo3.png') }}" alt="Logo" width="200" height="150">
    <h2 style="color: #13315C; text-align:center">Stayscape Transaction</h2>
    <br>
    <table>
        <tr>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Duration</th>
        </tr>
        <tr>
            <td>{{ strftime('%a, %e %B %Y at %H:%M:%S', strtotime($transactions->check_in_at)) }}</td>
            <td>{{ strftime('%a, %e %B %Y at %H:%M:%S', strtotime($transactions->check_out_at)) }}</td>
            <td>{{ $transactions->lama_penginapan }} Night</td>
        </tr>
    </table>

    <br>

    <table>
        <tr>
            <th>Customer Name</th>
            <th>ID Transaksi</th>
        </tr>
        <tr>
            <td>{{ $transactions->user->nama }}</td>
            <td>#{{ $transactions->id_transaksi}}</td>
        </tr>
    </table>

    {{-- Detail kamar --}}
    <hr>
    <h3>Detail Room</h3>
    <table>
        <tr>
            <td>Number of Room</td>
            <td>{{ $transactions->kamar->no_kamar }}</td>
        </tr>
        <tr>
            <td>Type</td>
            <td>{{ $transactions->kamar->tipe_kamar }}</td>
        </tr>
        <tr>
            <td>Max Capacity</td>
            <td>{{ $transactions->kamar->kapasitas }} person</td>
        </tr>
        <tr>
            <td>Price / night</td>
            <td>IDR {{ $transactions->kamar->harga }}</td>
        </tr>
    </table>

    <hr>
    <h3>Cancellation Policy</h3>
    <p>At StayScape Accommodation, we understand that sometimes plans change and it may be necessary to cancel a
        booking. Please carefully review our cancellation policy below:</p>
    <ol>
        <li>Cancellation made more than 72 hours prior to the scheduled check-in date: You will receive a full refund of
            the booking amount.</li>
        <li>Cancellation made between 24 to 72 hours prior to the scheduled check-in date: A cancellation fee equivalent
            to one night's stay will be charged, and the remaining amount will be refunded.</li>
        <li>Cancellation made less than 24 hours prior to the scheduled check-in date or in case of a no-show: No refund
            will be provided.</li>
    </ol>

    <hr>
    <h3>Detail Price</h3>
    <table>
        <tr>
            <td>Stayscape Room number {{ $transactions->kamar->no_kamar }}, Type {{ $transactions->kamar->tipe_kamar }}
                X{{ $transactions->lama_penginapan }}</td>
            <td style="font-size: 18px; font-weight:600 ">IDR {{ $transactions->total_harga }}</td>
        </tr>
        <tr>
            <td>Payment Status</td>
            <td style="font-size: 18px; font-weight:600 ">{{ $transactions->pembayaran }}</td>
        </tr>
    </table>
    <br><br>
    <h2 style="text-align: right; color:green; font-weight:800">#BOOKING</h2>
</body>

</html>

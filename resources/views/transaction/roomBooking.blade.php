@extends('main')

@section('konten')
@include('header')

<div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 700px">
        <div class="card-body">
            <form action="{{ route('booking.add', $rooms->id_kamar) }}" method="POST" class="d-inline">
                @csrf
            <h5 class="text-center" style="font-weight: 700; color: #8DA9C4" >Booking Room</h5>
            <hr>
            <input type="hidden" name="id_kamar" value="{{ $rooms->id_kamar }}">
            <div class="mb-3">
                <label for="inputNoRoom" class="form-label">Number of Room</label>
                <input type="text" class="form-control" id="inputNoRoom" value="Room {{ $rooms->no_kamar }}" disabled >
            </div>
            <div class="mb-3">
                <label for="inputType" class="form-label">Type of Room</label>
                <input type="text" class="form-control" id="inputType" value="{{ $rooms->tipe_kamar }}" disabled>
            </div>
            <div class="mb-4">
                <label for="inputHarga" class="form-label">Price /night</label>
                <input type="text" class="form-control" id="inputHarga" value="IDR {{ $rooms->harga }}" disabled>
            </div>
            <div class="mb-4">
                <label for="inputHarga" class="form-label">Time Check In</label>
                <input type="datetime-local" class="datetime" style="margin-left: 50px; border-radius:8px; width: 250px" name="check_in_at" required>
            </div>
            <div class="mb-5">
                <label for="inputHarga" class="form-label">Time Check Out</label>
                <input type="datetime-local" class="datetime" style="margin-left: 37px; border-radius:8px; width: 250px"
                    name="check_out_at" required >
            </div>
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            <div class="mb-3 d-flex justify-content-center">
                <a href="/dashboard" type="button" class="btn btn-secondary me-3">Cancel</a>
                    <button type="submit" class="btn btn-success me-3">Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

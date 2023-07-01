@extends('main')

@section('konten')
@include('header')

<div class="ms-4">
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide carousel-fade pointer-event" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item"><img style="width:1480px; height: 550px" src="{{ asset('3.png') }}"
                        alt="website template image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width:900px;"><i
                                class="fa fa-home fa-4x text-primary mb-4 d-none d-sm-block"></i>
                            <h3 class="display-3 text-uppercase text-white mb-md-4 fw-semibold">Experience Unparalleled Comfort and
                                Serenity at StayScape</h3>
                            <a href="#our-services" class="btn btn-info py-md-2 px-md-4 mt-2">Our Services</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item active"><img style="width:1480px; height: 550px" src="{{ asset('6.png') }}"
                        alt="website template image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width:900px;"><i
                                class="fa fa-tools fa-4x text-primary mb-4 d-none d-sm-block"></i>
                            <h6 class="display-2 text-uppercase text-white mb-md-4 fw-semibold">Enter the World of
                                <em>Stayscpae</em> in Amazing and Beauty Lodging</h6>
                            <a href="#booking" class="btn btn-info py-md-2 px-md-4 mt-2">Booking Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span> <span
                    class="visually-hidden">Previous</span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span> <span
                    class="visually-hidden">Next</span></button>
        </div>
    </div>

    <div class="col-lg-10 offset-lg-1">
        <div class="header-text mt-3">
            <br>
            <h3 id="our-services" style="color: #13315C;font-weight:700;">Discover a World of Relaxation at StayScape </h3>
            <p>StayScape is a premier accommodation destination that offers a perfect blend of comfort, serenity and
                convenience. Nestled in breathtaking surroundings, StayScape provides a tranquil escape from the hustle
                and bustle of everyday life.
                Our accommodations are designed to cater to the diverse needs of our guests, whether you're seeking a
                romantic getaway, a family vacation, or a business retreat. From cozy rooms with modern amenities to
                spacious suites with panoramic views, StayScape offers a range of options to suit your preferences.</p>
            <br>
        </div>
    </div>

    <hr><br>
    <h3 id="our-services" style="color: #13315C; margin-left:10px; font-weight:700; text-align:center">Our Services</h3>
    <div class="row single-page-nav m-auto">
        <div class="sigma-content col-lg-4 col-md-6 sigma-bg-lightgray">
            <img src="{{ asset('5.png') }}" class="card-img-top" alt="Room Image" style="border-radius: 25px">
            <h4 class="furnitures_text">Gym</h4>
            <p class="dummy_text">StayScape provides a fully equipped gym facility with modern equipment. Enjoy a wide range of comprehensive fitness equipment for cardio, strength training,
                and agility exercises.</p>
        </div>
        <div class="sigma-content col-lg-4 col-md-6 sigma-bg-gray">
            <img src="{{ asset('1.png') }}" class="card-img-top" alt="Room Image" style="border-radius: 25px">
            <h4 class="furnitures_text">Swimming Pool</h4>
            <p class="dummy_text">StayScape features a beautiful and refreshing swimming pool. Our swimming pool is designed to provide a comfortable and enjoyable swimming
                experience for guests.</p>
        </div>
        <div class="sigma-content col-lg-4 col-md-12 sigma-bg-darkgray">
            <img src="{{ asset('4.png') }}" class="card-img-top" alt="Room Image" style="border-radius: 25px">
            <h4 class="furnitures_text">Restaurant</h4>
            <p class="dummy_text">StayScape offers a delightful dining experience at our restaurant. Enjoy a wide selection of delicious dishes made from fresh, locally sourced
                ingredients.</p>
        </div>
    </div>
    <br><br>
    <hr><br>
    <h3 id="booking" style="color: #13315C; margin-left:10px; font-weight:700; text-align:center">Our Rooms</h3>
</div>
<div class="row" style="margin-block: 5vh; margin-left:20px; margin-right:20px">
    @foreach($rooms as $room)
    <div class="col-sm-4 mb-4">
        <div class="card">
            <div class="card-body">
                <!-- Tampilkan data sesuai kebutuhan -->
                <h5 class="text-center" style="font-weight: 700; color: #8DA9C4">Detail Room</h5>
                <hr>
                <p class="card-text fw-semibold" style="color: #13315C"> The room is {{ $room->status }} </p>
                <p class="card-text fw-semibold"><i class="bi bi-wifi"></i> Free Wifi</p>
                <p class="card-text fw-semibold"><i class="bi bi-bookmark-heart"></i> Type : {{ $room->tipe_kamar }}</p>
                <p class="card-text fw-semibold"><i class="bi bi-person-fill"></i></i> Max : {{ $room->kapasitas }}
                    person </p>
                <p class="card-text fw-semibold"> <i class="bi bi-moon"></i> In room {{ $room->no_kamar }} </p>
                <p class="card-text fw-bold" style="font-size: 22px; color:blue; text-align: right">IDR
                    {{ $room->harga }} </p>
                <p class="card-text fw-normal" style="font-size: 12px; text-align: right">/room/night</p>
                <br>
                @if(Auth::user()->role == 'customer')
                <button class="d-grid gap-2  col-6 d-md-block btn btn-primary mx-auto">
                    <p class="card-text fw-semibold"> Booking </p>
                </button>
                @endif

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
                                            <option value="not ready" {{ $room->status == 'not ready' ? 'selected' : '' }}>
                                                Not Ready</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editKapasitas" class="form-label">Capacity of Room</label>
                                        <input type="number" class="form-control" id="editKapasitas" name="kapasitas"
                                            value="{{ $room->kapasitas }}">
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
                <br>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

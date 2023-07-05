@extends('main')

@section('konten')
@include('header')

<div class="container">
    <div class="ms-4">
        <div class="container-fluid p-0">
            <div id="header-carousel" class="carousel slide carousel-fade pointer-event" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item"><img style="width:1480px; height: 600px" src="{{ asset('3.png') }}"
                            alt="website template image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width:900px;"><i
                                    class="fa fa-home fa-4x text-primary mb-4 d-none d-sm-block"></i>
                                <h3 class="display-3 text-uppercase text-white mb-md-4 fw-semibold">Experience
                                    Unparalleled
                                    Comfort and
                                    Serenity at StayScape</h3>
                                <a href="#our-services" class="btn btn-info py-md-2 px-md-4 mt-2">Our Facilities</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item active"><img style="width:1480px; height: 600px"
                            src="{{ asset('6.png') }}" alt="website template image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width:900px;"><i
                                    class="fa fa-tools fa-4x text-primary mb-4 d-none d-sm-block"></i>
                                <h6 class="display-2 text-uppercase text-white mb-md-4 fw-semibold">Enter the World of
                                    <em>Stayscpae</em> in Amazing and Beauty Lodging</h6>
                                <a href="#room-views" class="btn btn-info py-md-2 px-md-4 mt-2">Our Rooms</a>
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


        <div class="col-lg-10 ">
            <div class="header-text mt-3">
                <br>
                <h1 style="color: #13315C;font-weight:700;">Discover a World of Relaxation at StayScape
                </h1>
                <p>StayScape is a premier accommodation destination that offers a perfect blend of comfort, serenity and
                    convenience. Nestled in breathtaking surroundings, StayScape provides a tranquil escape from the
                    hustle
                    and bustle of everyday life.
                    Our accommodations are designed to cater to the diverse needs of our guests, whether you're seeking
                    a
                    romantic getaway, a family vacation, or a business retreat. From cozy rooms with modern amenities to
                    spacious suites with panoramic views, StayScape offers a range of options to suit your preferences.
                </p>
                <br>
            </div>
        </div>
        <br>


        <br>
        <h2 id="our-services" style="color: #13315C; margin-left:10px; font-weight:700; text-align:center">Our
            Facilities
        </h2>
        <br>
        <div class="row single-page-nav m-auto">
            <div class="sigma-content col-lg-4 col-md-6 sigma-bg-lightgray">
                <img src="{{ asset('7.jpg') }}" class="card-img-top" alt="Room Image" style="border-radius: 25px">
                <h5 class="furnitures_text fw-bold mt-2">Reception</h5>
                <p class="dummy_text">The reception area is the first point of contact when you enter a hotel. It is
                    staffed by concierge or front desk personnel who assist guests with check-in, check-out, and provide
                    information about the hotel's services, facilities, and local attractions. They can also help with
                    arranging transportation, making reservations, and addressing any guest inquiries or concerns.</p>
            </div>
            <div class="sigma-content col-lg-4 col-md-6 sigma-bg-gray">
                <img src="{{ asset('2.png') }}" class="card-img-top" alt="Room Image" style="border-radius: 25px">
                <h5 class="furnitures_text fw-bold mt-2">Business and Conference Facilities</h5>
                <p class="dummy_text">Hotels frequently offer facilities for business travelers, such as meeting rooms,
                    conference halls, or business centers. These spaces are equipped with audiovisual equipment,
                    internet access, and other necessary amenities for conducting meetings, conferences, or
                    presentations. Business travelers can also utilize services like printing, photocopying, or
                    secretarial assistance.</p>
            </div>
            <div class="sigma-content col-lg-4 col-md-6 sigma-bg-gray">
                <img src="{{ asset('8.jpg') }}" class="card-img-top" alt="Room Image" style="border-radius: 25px">
                <h5 class="furnitures_text fw-bold mt-2">Parking and Transportation</h5>
                <p class="dummy_text">Hotels often have parking facilities, either in the form of on-site parking or
                    partnerships with nearby parking lots. Some hotels may also offer transportation services, such as
                    airport shuttles or car rentals, to assist guests with their travel needs.</p>
            </div>
            <div class="sigma-content col-lg-4 col-md-6 sigma-bg-lightgray mt-4">
                <img src="{{ asset('5.png') }}" class="card-img-top" alt="Room Image" style="border-radius: 25px">
                <h5 class="furnitures_text fw-bold mt-2">Gym</h5>
                <p class="dummy_text">StayScape provides a fully equipped gym facility with modern equipment. Enjoy a
                    wide
                    range of comprehensive fitness equipment for cardio, strength training,
                    and agility exercises.</p>
            </div>
            <div class="sigma-content col-lg-4 col-md-6 sigma-bg-gray mt-4">
                <img src="{{ asset('1.png') }}" class="card-img-top" alt="Room Image" style="border-radius: 25px">
                <h5 class="furnitures_text fw-bold mt-2">Swimming Pool</h5>
                <p class="dummy_text">StayScape features a beautiful and refreshing swimming pool. Our swimming pool is
                    designed to provide a comfortable and enjoyable swimming
                    experience for guests.</p>
            </div>
            <div class="sigma-content col-lg-4 col-md-12 sigma-bg-darkgray mt-4">
                <img src="{{ asset('4.png') }}" class="card-img-top" alt="Room Image" style="border-radius: 25px">
                <h5 class="furnitures_text fw-bold mt-2">Restaurant</h5>
                <p class="dummy_text">StayScape offers a delightful dining experience at our restaurant. Enjoy a wide
                    selection of delicious dishes made from fresh, locally sourced
                    ingredients.</p>
            </div>
        </div>
        <br><br>

        <br>
        <h2 id="room-views" style="color: #13315C; margin-left:10px; font-weight:700; text-align:center">Our Rooms</h2>
        <br>
        <div class="row single-page-nav m-auto">
            <div class="sigma-content col-lg-4 col-md-6 sigma-bg-lightgray">
                <img src="{{ asset('single-room.jpg') }}" class="card-img-top" alt="Room Image"
                    style="border-radius: 25px">
                <h5 class="furnitures_text fw-bold mt-2">Single Room</h5>
                <p class="dummy_text">A single room in a hotel is designed for solo travelers or guests who prefer their
                    own
                    private space. It typically features a single bed and amenities suited for one person. Single rooms
                    offer comfort and convenience, providing all the necessary facilities for a comfortable stay,
                    including
                    a private bathroom, work desk, and basic amenities.</p>
            </div>
            <div class="sigma-content col-lg-4 col-md-6 sigma-bg-gray">
                <img src="{{ asset('double-room.jpg') }}" class="card-img-top" alt="Room Image"
                    style="border-radius: 25px">
                <h5 class="furnitures_text fw-bold mt-2">Double Room</h5>
                <p class="dummy_text">A double room in a hotel is suitable for two guests and usually comes with a queen
                    or
                    king-size bed. It offers more space compared to a single room, providing ample room for two people
                    to
                    relax and unwind. Double rooms are equipped with amenities like a private bathroom, seating area,
                    and
                    additional features such as a minibar or coffee maker, ensuring a comfortable stay for couples or
                    friends traveling together.</p>
            </div>
            <div class="sigma-content col-lg-4 col-md-12 sigma-bg-darkgray">
                <img src="{{ asset('family-room.jpg') }}" class="card-img-top" alt="Room Image"
                    style="border-radius: 25px">
                <h5 class="furnitures_text fw-bold mt-2">Family Room</h5>
                <p class="dummy_text">A family room in a hotel is specifically designed to accommodate families or
                    larger
                    groups. It typically consists of multiple beds, such as a combination of a double bed and twin beds
                    or
                    bunk beds. Family rooms are spacious and often feature additional seating areas or a separate living
                    space, allowing families to have quality time together. These rooms are equipped with amenities that
                    cater to the needs of families, including a private bathroom, television, and sometimes even a
                    kitchenette or mini-fridge.</p>
            </div>
        </div>
        <br><br>
    </div>




</div>

@endsection

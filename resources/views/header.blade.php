<header class="p-3 mb-3 border-bottom" style="background-color: rgb(238, 247, 255)">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="" class="d-flex align-items-center px-3 mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
            <img src="" alt="">
            <img style="width:30px; height: 30px" src="{{ asset('logo3.png') }}" alt="logo">
         <h5 class="mx-2" style="color: #13315C; font-weight: 700"> Stayscape  </h5>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="/dashboard" class="nav-link px-2 link-body-emphasis"> Dashboard</a></li>

          <li><a href="/katalogRooms" class="nav-link px-2 link-body-emphasis">Rooms</a></li>

          @can('view-rooms')
          <li><a href="/customers" class="nav-link px-2 link-body-emphasis">Customers</a></li>
          @endcan

          @can('view-transactions')
          <li><a href="/transactions" class="nav-link px-2 link-body-emphasis">Transactions</a></li>
          @endcan

          @if(Auth::user()->role == 'customer')
          <li><a href="/booking" class="nav-link px-2 link-body-emphasis">Booking</a></li>
          {{-- <li><a href="#" class="nav-link px-2 link-body-emphasis">Products</a></li> --}}
          @endif
        </ul>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('ppp.jpg') }}" alt="mdo" width="29" height="29" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" style="">
            <li><a class="dropdown-item" href="/updatePassword">Settings</a></li>
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
            <form method="POST" action="{{ route('logOut') }}">
                @csrf
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">Sign Out</a>
            </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>


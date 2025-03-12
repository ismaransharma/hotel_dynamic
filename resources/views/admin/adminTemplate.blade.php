<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Vertical Navbar</title>
   

    
    <link rel="stylesheet" href="{{ asset('site/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/fontawesome/all.css') }}">
    <link rel="stylesheet" href="{{ asset('site/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/utility.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/media.css') }}" />
  </head>

  <body>
    <section id="mainNav">
        <div id="menuToggle" class="menu-toggle">
          <i class="fas fa-bars"></i>
        </div>
      
        <div id="navbar" class="navbar">
     
          <a href="{{ route('getAdminPreBooking') }}" class="gapp-1 {{ Request::routeIs('getAdminPreBooking') || Request::routeIs       ('getAdminHome') ? 'active' : '' }}">
            <i class="fa-solid fa-book-bookmark"></i> Pre Booking
          </a>
        
          
          <a href="{{ route('getAdminBooked') }}" class="gapp-1 {{ Request::routeIs('getAdminBooked') ? 'active' : '' }}">
            <i class="fa-solid fa-bookmark"></i> Booked & <br> Arrived
          </a>
          <a href="{{ route('getAdminCheckedIn') }}" class="gapp-1 {{ Request::routeIs('getAdminCheckedIn') ? 'active' : '' }}">
            <i class="fa-solid fa-user-check"></i> Checked In
          </a>
          <a href="{{ route('getAdminRoomCancelled') }}" class="gapp-1 {{ Request::routeIs('getAdminRoomCancelled') ? 'active' : '' }}">
            <i class="fa-solid fa-xmark"></i> Cancelled
          </a>
          <a href="{{ route('getAdminMaps') }}" class="gapp-1 {{ Request::routeIs('getAdminMaps') ? 'active' : '' }}">
            <i class="fa-solid fa-earth-asia"></i> Map
          </a>
          <!-- Dropdown menu -->
          <div class="dropdown w-100p">
            <a
              href="#"
              class="dropdown-toggle gapp-1 {{ Request::is('admin/rooms', 'admin/gallery', 'admin/contact-us') ? 'active' : '' }}"
              id="dropdownMenuLink"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="fas fa-cog"></i> Pages
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item {{ Request::routeIs('getAdminRoom') ? 'active' : '' }}" href="{{ route('getAdminRoom') }}">Room</a></li>
              <li><a class="dropdown-item {{ Request::routeIs('getAdminGallery') ? 'active' : '' }}" href="{{ route('getAdminGallery') }}">Gallery</a></li>
              <li><a class="dropdown-item {{ Request::routeIs('getAdminContactUs') ? 'active' : '' }}" href="{{ route('getAdminContactUs') }}">Contact</a></li>
            </ul>
          </div>
        </div>
      </section>
      
    @yield('content');

    <script src="{{ asset('admin/js/script.js') }}"></script>
    <script src="{{ asset('site/jquery/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('admin/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('site/fontawesome/all.js') }}"></script>

    <script>

      @if(Session::has('success'))
      toastr.options = {
          "closeButton": true,
          "progressBar": true,
      }
      toastr.success("{{ Session('success') }}");
      @elseif(Session::has('error'))
      toastr.options = {
          "closeButton": true,
          "progressBar": true,
      }
      toastr.error("{{ Session('error') }}");
      @endif
  </script>

  </body>
</html>

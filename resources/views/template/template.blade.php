<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel</title>

    
    <link rel="stylesheet" href="{{ asset('site/fontawesome/all.css') }}">
    <link rel="stylesheet" href="{{ asset('site/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/utility.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/media.css') }}" />
    
  </head>
  <body>
    <section id="topHeader">
      <div class="container">
        <div class="row">
          <div class="col-md-6 left white">
            <div class="row">
              <div class="col-md-6">
                <div class="location">
                  <i class="fa-solid fa-location-dot"></i>
                  <span>{{ $contactUs->address }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="phone">
                  <i class="fa-solid fa-phone"></i>
                  <span>+977 {{ $contactUs->number }}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 right">
            <div class="fb">
              <a href="https://facebook.com" target="_blank">
                <i class="fa-brands fa-facebook-f"></i>
              </a>
            </div>
            <div class="insta">
              <a href="https://instagram.com" target="_blank">
                <i class="fa-brands fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="navbar">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand ageagea" href="{{ route('getHome') }}">
            <img src="{{ asset('site/imgs/logo.png') }}" alt="Logo Img" />
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse jc-sa" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link{{ $activePage == 'home' ? ' active' : '' }}" href="{{ route('getHome') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link{{ $activePage == 'rooms' ? ' active' : '' }}" href="{{ route('getRooms') }}">Rooms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link{{ $activePage == 'aboutUs' ? ' active' : '' }}" href="{{ route('getAboutUs') }}">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link{{ $activePage == 'gallery' ? ' active' : '' }}" href="{{ route('getGallery') }}">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link{{ $activePage == 'contactUs' ? ' active' : '' }}" href="{{ route('getContactUs') }}">Contact</a>
              </li>
            </ul>
          </div>
          
        </nav>
      </div>
    </section>

    @yield('template')

    <section id="footer">
      <div class="container tac">
        <h2>© 2024 All Rights Reserved Terms of Use and Privacy Policy</h2>
      </div>
    </section>

    <script src="{{ asset('site/js/script.js') }}"></script>
    <script src="{{ asset('site/jquery/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('admin/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('site/fontawesome/all.js') }}"></script>

    <script>
      @if(Session::has('success'))
      toastr.options = {
          "closeButton": true,
          "progressBar": true,
          "timeOut": 8000,  
      }
      toastr.success("{{ Session('success') }}");
      @elseif(Session::has('error'))
      toastr.options = {
          "closeButton": true,
          "progressBar": true,
          "timeOut": 8000,  
      }
      toastr.error("{{ Session('error') }}");
      @endif
  </script>
  

  </body>
</html>

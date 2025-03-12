@extends('template.template')
@section('template')

    <section id="hero">
      <div class="container-fluid">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                  <img class="d-block w-100" src="{{ asset('site/imgs/hotelEdis.jpg') }}" alt="First slide" />
                  <div class="texts">
                  <h2>Welcome to Siddhartha Park Regency</h2>
                  <h4>Hotel, Spa & Restro</h4>
                  </div>
              </div>
              <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('site/imgs/room1.jpg') }}" alt="Second slide" />
                  <div class="texts aagea">
                  <h2>Welcome to Siddhartha Park Regency</h2>
                  <h4>Hotel, Spa & Restro</h4>
                  </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <i class="fa-solid fa-arrow-right"></i>
            <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </section>
  

  <section id="checkAvailability">
    <div class="container">
      <form action="{{ route('postCheckAvailability') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-4">
            <div class="box">
              <div class="inpts">
                <h3>Arrival Date</h3>
                <input type="date" name="arrival" required/>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box">
              <div class="inpts">
                <h3>Departure Date</h3>
                <input type="date" name="departure" required />
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="hiahf">
              <button class="btnAll">Check Availability</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>

  <section id="ourRooms">
    <div class="container">
      <div class="upper tac">
        <h3>Our Rooms</h3>
        <h5>
          When you host a party or family reunion, the special celebrations
          <br />
          let you streng then bonds with
        </h5>
      </div>
      <div class="cnct my-5">
        <div class="row">
          @foreach ($rooms as $room)
          <div class="col-md-4 my-5">
            <a href="{{ route('getRoomDetails', $room->slug) }}">
              <div class="card">
                <div class="image">
                  <img src="{{ asset('uploads/room_images/'. $room->room_image) }}" alt="Room Image" />
                </div>
                <div class="text tac">
                  <h3>{{ $room->room_title }}</h3>
                  <h5>Rs. {{ $room->price }} / Per Night</h5>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section id="aboutUs">
    <div class="container">
      <div class="row">
        <div class="col-md-6 left">
          <h3>About Us</h3>
          <h5>
            Contrary to popular belief, Lorem isn’t simply random text. It has
            roots in a of classical Latin literature from 45 BC, making it
            over 2000 years old. Avalon’s leading hotels with gracious island
            hospitality, thoughtful amenities and distinctive.
            <br />
            <br />
            Richard McClintock, a Latin professor at Hampden-Sydney College in
            Virginia, looked up one of the more obscure Latin words,
            consectetur, from a Lorem Ipsum passage ...
          </h5>
          <a href="aboutUs.html">
            <button>Read More</button>
          </a>
        </div>
        <div class="col-md-6 right">
          <div class="image">
            <img src="{{ asset('site/imgs/abt-us.jpeg') }}" alt="About Us Image" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="reviews">
    <div class="container-fluid p-0">
      <div class="bgImg">
        <div class="overlay"></div>
        <div class="container">
          <div class="testimonial-container">
            <div class="testimonial">
              <div class="boxCenter">
                <div class="cnct tac">
                  <img src="{{ asset('site/imgs/man1.jpg') }}" alt="" />
                  <h4>
                    ​‌ “This is the only place to stay in Parasi! I have
                    stayed in the cheaper hotels and they were fine, but this
                    is just the icing on the cake! After spending the day bike
                    riding and hiking to come back and enjoy a glass of wine.”
                  </h4>
                  <h2>Sambhav Gyawali</h2>
                  <h3>From Birauta, Pokhara</h3>
                </div>
              </div>
            </div>

            <div class="testimonial">
              <div class="boxCenter">
                <div class="cnct tac">
                  <img src="{{ asset('site/imgs/man2.jpg') }}" alt="" />
                  <h4>
                    ​‌ “This is the only place to stay in Parasi! I have
                    stayed in the cheaper hotels and they were fine, but this
                    is just the icing on the cake! After spending the day bike
                    riding and hiking to come back and enjoy a glass of wine.”
                  </h4>
                  <h2>Saugat Kasaudhan</h2>
                  <h3>From Nayabazar, Kathmandu</h3>
                </div>
              </div>
            </div>

            <div class="testimonial">
              <div class="boxCenter">
                <div class="cnct tac">
                  <img src="{{ asset('site/imgs/man2.jpg') }}" alt="" />
                  <h4>
                    ​‌ ​‌ “This is the only place to stay in Parasi! I have
                    stayed in the cheaper hotels and they were fine, but this
                    is just the icing on the cake! After spending the day bike
                    riding and hiking to come back and enjoy a glass of wine.”
                  </h4>
                  <h2>Sushant Aryal</h2>
                  <h3>From Milan Chowk, Butwal</h3>
                </div>
              </div>
            </div>
          </div>

          <div class="bottomBar">
            <button class="nav-button prev" onclick="prevReview()">
              &#10094;
            </button>
            <button class="nav-button next" onclick="nextReview()">
              &#10095;
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>


  @if ($galleries->count() > 0)
  <section id="gallery">
    <div class="container">
      <div class="upper tac">
        <h2>Gallery</h2>
      </div>
      <div class="cnct">
        <div class="row">
          @foreach ($galleries as $gallery)
          <div class="col-md-3">
            <img src="{{ asset('uploads/gallery/'. $gallery->image) }}" alt="Gallery Image" />
          </div>
          @endforeach
        </div>
      </div>
      <div class="viewMore tac my-4">
        <a href="{{ route('getGallery') }}">
          <button class="btnAll">View More</button>
        </a>
      </div>
    </div>
  </section>
  @endif

  <section id="weOffer" class="m-0">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="image">
            <img src="{{ asset('site/imgs/what-we-offer.jpg') }}" alt="" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="cnct">
            <h2>
              What Activities <br />
              We Offer
            </h2>
            <h6>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Commodi, repellat voluptatem autem atque esse quo corrupti
              molestiae voluptas provident eligendi, aut officia doloribus
              saepe fugiat vitae! Maxime sequi cupiditate ab.
            </h6>
            <div class="row">
              <div class="col col-sm-6 col-md-6">
                <i class="fa-solid fa-champagne-glasses"></i>
                <span>Club</span>
              </div>
              <div class="col col-sm-6 col-md-6">
                <i class="fa-solid fa-bed"></i>
                <span>Rooms</span>
              </div>
              <div class="col col-sm-6 col-md-6">
                <i class="fa-solid fa-utensils"></i>
                <span>Dining</span>
              </div>
              <div class="col col-sm-6 col-md-6">
                <i class="fa-solid fa-drumstick-bite"></i>
                <span>BBQ</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="ourAchievements">
    <div class="container">
      <div class="upper tac">
        <h2>Our Achievements</h2>
        <h5>We are the top leading hotel with 5 years of experience</h5>
      </div>
      <div class="cnct tac">
        <div class="row">
          <div class="col-md-4">
            <h2>15k</h2>
            <h3>Happy Clients</h3>
          </div>
          <div class="col-md-4">
            <h2>25</h2>
            <h3>Total Rooms</h3>
          </div>
          <div class="col-md-4">
            <h2>20</h2>
            <h3>Team Members</h3>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="center tac">
              <i class="fa-solid fa-mobile"></i>
              <h3>+977 9876543210</h3>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="center tac">
              <i class="fa-solid fa-location-dot"></i>
              <h3>Ramgram-3, Parasi</h3>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="center tac">
              <i class="fa-solid fa-envelope"></i>
              <h3>abc@gmail.com</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="map">
    <div class="container-fluid p-0">
      {!! $maps->map !!}
    </div>
  </section>

@endsection
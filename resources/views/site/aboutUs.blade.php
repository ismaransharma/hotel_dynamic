@extends('template.template')
@section('template')


<section id="breadcrumb">
    <div class="container tac">
      <h2>About Us</h2>
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
  
@endsection
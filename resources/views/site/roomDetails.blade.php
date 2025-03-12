@extends('template.template')
@section('template')

<section id="breadcrumb">
    <div class="container tac">
      <h2>Rooms & Rate</h2>
      <h5>{{ $roomDetail->room_title }}</h5>
    </div>
  </section>

  <section id="roomDetails">
    <div class="container">
      <div class="row">
        <div class="col-md-6 left">
          <div class="image">
            <img src="{{ asset('uploads/room_images/'. $roomDetail->room_image) }}" alt="Room Image" />
          </div>
        </div>
        <div class="col-md-6 right">
          <div class="cnct">
            <div class="upperADesc">
              <span class="title">{{ $roomDetail->room_title }}</span>
              @if ($roomDetail->status == "active")
              <span class="aNN">Available</span>
              @else
              <span class="nNN">Not Available</span>
              
              @endif
              <br>
              <span class="price">Rs. {{ $roomDetail->price }}</span> <span class="night">/ Night</span>
              <h5>{{ $roomDetail->room_description }}</h5>
            </div>
            <div class="inpt">
              <form action="{{ route('postPreBooking', $roomDetail->id) }}" method="POST">
                @csrf
                <div class="arrDep">
                  <div class="row">
                    <div class="col-md-6 agrag">
                      <input
                        type="date"
                        name="arrival"
                        id="arrivalDate"
                        placeholder=" " required 
                      />
                      <label for="arrivalDate">Arrival Date</label>
                    </div>
                    <div class="col-md-6 agrag l-4">
                      <input
                        type="date"
                        name="departure"
                        id="departureDate"
                        placeholder=" " required
                      />
                      <label for="departureDate">Departure Date</label>
                    </div>
                  </div>
                </div>
  
                <div class="mmbr">
                  <div class="row">
                    <div class="col-md-6 ahuigrera">
                      <input
                        type="number"
                        name="adult"
                        id="adult"
                        placeholder=" "
                        value="2" required
                      />
                      <label for="adult">Adult</label>
                    </div>
                    <div class="col-md-6 ahuigrera">
                      <input
                        type="number"
                        name="children"
                        id="children"
                        placeholder=" "
                        value="2" required
                      />
                      <label for="children">Children</label>
                    </div>
                  </div>
                </div>
  
                <div class="details">
                  <input
                    type="text"
                    name="user_name"
                    placeholder="Enter Your Name" required
                  />
                  <br />
                  <input
                    type="email"
                    name="user_email"
                    placeholder="Enter Your Email" required
                  />
                  <br>
                  <input
                    type="number"
                    name="user_number"
                    placeholder="Enter Your Number" required
                  />
                </div>
  
                <div class="button tac my-5">
                  <button class="btnAll" type="submit">Book Now</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection
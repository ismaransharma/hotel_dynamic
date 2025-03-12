@extends('template.template')
@section('template')

  <section id="breadcrumb">
    <div class="container tac">
      <h2>Rooms & Rate</h2>
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


@endsection
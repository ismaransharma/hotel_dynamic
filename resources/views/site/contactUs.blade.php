@extends('template.template')
@section('template')

<section id="breadcrumb">
    <div class="container tac">
      <h2>Contact Us</h2>
    </div>
  </section>

  <section id="map">
    <div class="container-fluid p-0">
      {!! $maps->map !!}
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="center tac">
              <i class="fa-solid fa-mobile"></i>
              <h3>+977 {{ $contactUs->number }}</h3>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="center tac">
              <i class="fa-solid fa-location-dot"></i>
              <h3>{{ $contactUs->address }}</h3>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="center tac">
              <i class="fa-solid fa-envelope"></i>
              <h3>{{ $contactUs->email }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
@endsection
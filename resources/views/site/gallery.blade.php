@extends('template.template')
@section('template')

  <section id="breadcrumb">
    <div class="container tac">
      <h2>Gallery</h2>
    </div>
  </section>

  <section id="gallery">
    <div class="container">
      <div class="cnct">
        <div class="row">
          @foreach ($galleries as $gallery)
          <div class="col-md-3">
            <img src="{{ asset('uploads/gallery/'. $gallery->image) }}" alt="Gallery Image" />
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

@endsection
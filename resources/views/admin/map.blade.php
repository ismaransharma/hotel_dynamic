@extends('admin.adminTemplate')
@section('content')

<section id="wrapper">
  <div id="dashboard">
    <div class="container-fluid">
      <!-- Map  -->

      <div class="row map">
        <div class="col-md-12">
          <form action="{{ route('postMap') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4>Map</h4>
                </div>
                <div class="card-body">
                    <h5>Enter Map Embed code here</h5>
                    <textarea name="map" id="map" class="form-control @error('map') is-invalid @enderror" rows="5">{{ old('map', $maps->map ?? '') }}</textarea>
                    @error('map')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
        </div>
      </div>

      <div class="row showMap my-5">
        {!! $maps->map !!}
      </div>
    </div>
  </div>
</section> 



@endsection
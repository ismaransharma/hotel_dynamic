@extends('admin.adminTemplate')
@section('content')

<section id="wrapper">
  <div id="dashboard">
    <div class="container-fluid">
      <div class="row galleryPage">
        <!-- Gallery Section -->
        <div class="col-md-12 gallery my-5">
          <div class="row">
            <div class="col-md-12">
              <div class="header my-3">
                <h3>Gallery</h3>
              </div>
              <div class="cnct">
                  <div class="card">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-md-12 tae">
                          <button
                            type="button"
                            class="btn btn-primary fs-4"
                            data-bs-toggle="modal"
                            data-bs-target="#imageModal"
                          >
                            Add Image
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($galleries as $image)
                            <tr>
                              <th>{{ $loop->iteration }}</th>
                              <th>
                                <img
                                  src="{{ asset('uploads/gallery/'. $image->image) }}"
                                  alt="Gallery Image"
                                  class="agtbi"
                                />
                              </th>
                              <th>
                                  <button type="submit" class="btn btn-danger fs-5" data-bs-toggle="modal"
                                    data-bs-target="#deleteGalleryImageModal-{{ $image->id }}">
                                    Delete
                                  </button>
                              </th>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div
  class="modal fade"
  id="imageModal"
  tabindex="-1"
  aria-labelledby="imageModalLabel"
  aria-hidden="true"
 >
  <div class="modal-dialog">
    <form action="{{ route('postGalleryImage') }}" method="POST" enctype="multipart/form-data" >
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">Modal title</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
            <h2>Select Image</h2>
            <input type="file" name="image" id="image" class="border-0 @error('product_image') is-invalid @enderror" value="{{ old('image') }}" required >
            @error('image')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary fs-5"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button type="submit" class="btn btn-primary fs-5" id="save_product">Add Image </button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Delete Modal --}}


@foreach ($galleries as $image)
<div class="modal fade" id="deleteGalleryImageModal-{{ $image->id }}" tabindex="-1" aria-labelledby="deleteGalleryImageModal-{{ $image->id }}Label" aria-hidden="true">
  <div class="modal-dialog modal-lg afaeaetgarsg">
      <div class="modal-content afaeaetgarsg border-0">
          <section id="confirmation">
              <div class="container">
                  <div class="allCenter">
                  <div class="box">
                      <div class="cross end">
                      <button class="fa-solid fa-xmark closeCross" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="upper center">
                      <div class="mainCross">X</div>
                      <h2>Are You Sure?</h2>
                      </div>
                      <div class="text center">
                      <h6>
                          Do you really want to delete <b>chosen image</b> ? It cannot be restored!!
                      </h6>
                      </div>
                      <div class="buttons center">
                      <button class="btn cancel" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                      <a href="{{ route('deleteGalleryImage', $image->id) }}">
                          <button class="btn delete">Delete</button>
                      </a>
                      </div>
                  </div>
                  </div>
              </div>
          </section>
      </div>
  </div>
</div>
@endforeach

@endsection

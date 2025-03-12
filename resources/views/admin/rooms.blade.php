@extends('admin.adminTemplate')
@section('content')

<section id="wrapper">
    <div id="dashboard">
      <div class="container-fluid">
        <div class="row menusPage">
 
          <!-- Room Section -->
          <div class="col-md-12 menus my-5">
            <div class="row">
              <div class="col-md-12">
                <div class="header my-3">
                  <h3>Rooms</h3>
                </div>
              </div>
              <div class="cnct">
                  <div class="card">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-md-12 tae">
                          <button
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#addRoomModal"
                            class="btn btn-primary fs-5"
                          >
                            Add Room
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Price/N</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                            <tr>
                              <th>{{ $loop->iteration }}</th>
                              <th>{{ $room->room_title }}</th>
                              <th>
                                <img
                                  src="{{ asset('uploads/room_images/'. $room->room_image) }}"
                                  alt="Room Image"
                                  class="agtbi"
                                />
                              </th>
                              <th>{{ Str::limit($room->room_description ?? 'No Description', 15) }}</th>
                              <th>Rs. {{ $room->price }}</th>
                              <th>
                                @if ($room->status == "active")
                                    <h5 class="active">Active</h5>
                                @else
                                    <h5 class="inactive">Inactive</h5>
                                    
                                @endif
                              </th>
                              <th>
                                {{-- <button
                                  type="button"
                                  data-bs-toggle="modal"
                                  data-bs-target="#editProductModal-{{ $menu->id }}"
                                  class="btn btn-success"
                                >
                                  Edit
                                </button>
                                  <button type="submit" data-bs-toggle="modal"
                                  data-bs-target="#deleteProductModal-{{ $menu->id }}" class="btn btn-danger">Delete</button> --}}
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
  </section>

<!-- Add Modal -->
<div
  class="modal fade"
  id="addRoomModal"
  tabindex="-1"
  aria-labelledby="addRoomModalLabel"
  aria-hidden="true"
 >
  <div class="modal-dialog">
    <form action="{{ route('postAddRoom') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      <h3>Room Title</h3>
                      <input type="text" name="room_title" id="room_title" placeholder="Enter Room Name" />
                  </div>
                  <div class="col-md-12">
                      <h3>Room Image</h3>
                      <input type="file" name="room_image" id="room_image" class="border-0" />
                  </div>
                  <div class="col-md-12">
                      <h3>Description</h3>
                      <textarea name="room_description" id="room_description" placeholder="Enter Room Description"></textarea>
                  </div>
                  <div class="col-md-6">
                      <h3>Price</h3>
                      <input type="number" name="price" id="price" placeholder="Enter price per night" />
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary fs-5" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary fs-5">Add Room</button>
          </div>
      </div>
    </form>
  </div>
</div>

@endsection
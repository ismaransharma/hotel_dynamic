@extends('admin.adminTemplate')
@section('content')
  
<section id="wrapper">
  <div id="dashboard">
    <div class="container-fluid">
      <div class="row menusPage">
        <!-- Menu Section -->
        <div class="col-md-12 menus my-5">
          <div class="row">
            <div class="col-md-12">
              <div class="header my-3">
                <h3>Booked</h3>
              </div>
            </div>
            <div class="cnct">
                <div class="card">
                  <div class="card-header">
                    <form action="{{ route('getAdminSearchBooked') }}" method="GET">
                      <div class="row">
                          <div class="col-md-12 tae">
                            <input type="search" name="searchBooked" id="searchBooked" class="searchBooking" placeholder="Search by booking id">
                          </div>
                        </div>
                    </form>
                  </div>
                  <div class="card-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Booking Id</th>
                          <th>Room Id</th>
                          <th>Name</th>
                          <th>Arrival Date</th>
                          <th>Departure Date</th>
                          <th>Adult</th>
                          <th>Childern</th>
                          <th>Number</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($Booked as $book)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $book->booking_id }}</th>
                                <th>{{ $book->room_id }}</th>
                                <th>{{ $book->name }}</th>
                                <th>{{ $book->arrival_date }}</th>
                                <th>{{ $book->departure_date }}</th>
                                <th>{{ $book->adult }}</th>
                                <th>{{ $book->children }}</th>
                                <th>{{ $book->number }}</th>
                                <th>
                                    <button
                                      type="button"
                                      data-bs-toggle="modal"
                                      data-bs-target="#viewBookedModal-{{ $book->id }}"
                                      class="btn btn-primary"
                                    >
                                        <i class="fa-solid fa-eye icons"></i>
                                    </button>
                                    <button
                                      type="button"
                                      data-bs-toggle="modal"
                                      data-bs-target="#editBookedModal-{{ $book->id }}"
                                      class="btn btn-success"
                                    >
                                        <i class="fa-solid fa-pen icons"></i>
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
</section>


<!--View Modal -->
@foreach ($Booked as $book)
<div
    class="modal fade"
    id="viewBookedModal-{{ $book->id }}"
    tabindex="-1"
    aria-labelledby="viewBookedModal-{{ $book->id }}Label"
    aria-hidden="true"
    >
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="viewBookedModal-{{ $book->booking_id }}Label">View book In: {{ $book->booking_id }}</h5>
              <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              ></button>
          </div>
          <div class="modal-body">
              <div class="row">
                <div class="col col-md-6">
                  <h3>Name: {{ $book->name }}</h3>
                </div>
                <div class="col col-md-6">
                  <h3>Status: {{ $book->status }}</h3>
                </div>
                <hr>
                <div class="col col-md-6">
                  <h3>Arrival: {{ $book->arrival_date }}</h3>
                </div>
                <div class="col col-md-6">
                  <h3>Departure: {{ $book->departure_date }}</h3>
                </div>
                <hr>
                <div class="col col-md-6">
                  <h3>Room Id: {{ $book->room_id }}</h3>
                </div>
                <div class="col col-md-6">
                  <h3>Adult: {{ $book->adult }}</h3>
                </div>
                <hr>
                <div class="col col-md-6">
                  <h3>Children: {{ $book->children }}</h3>
                </div>
                <div class="col col-md-6">
                  <h3>Email: {{ $book->email }}</h3>
                </div>
                <hr>
                <div class="col col-md-6">
                  <h3>Number: {{ $book->number }}</h3>
                </div>
                <div class="col col-md-6">
                  <h3>Stayed: {{ $book->stayed }} Day/s</h3>
                </div>
                <hr>
                <div class="col col-md-6">
                  <h3>Total: Rs. {{ $book->total_price }}</h3>
                </div>
              </div>
          </div>
          <div class="modal-footer">
              <button
              type="button"
              class="btn btn-secondary fs-5"
              data-bs-dismiss="modal"
              >
              Close
              </button>
          </div>
        </div>
    </div>
</div>
@endforeach

<!--Edit Modal -->
@foreach ($Booked as $book)
<div
    class="modal fade"
    id="editBookedModal-{{ $book->id }}"
    tabindex="-1"
    aria-labelledby="editBookedModal-{{ $book->id }}Label"
    aria-hidden="true"
    >
    <div class="modal-dialog">
        <form action="{{ route('postEditBooked', $book->id) }}" method="POST">
          @csrf
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookingModal-{{ $book->booking_id }}Label">View Booked Room: {{ $book->booking_id }}</h5>
                <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col col-md-6">
                    <label for="name">Name: </label><input type="text" name="name" id="name" placeholder="Enter customer's name" value="{{ $book->name }}">
                  </div>
                  <div class="col col-md-6">
                    <label for="status">Status: </label>
                    <select name="status" id="status">
                      <option value="Booked" <?php if($book->status == 'Booked') {echo('selected');}?>>
                        Booked</option>
                      <option value="Arrived" <?php if($book->status == 'Arrived') {echo('selected');}?>>
                        Arrived</option>
                      <option value="Checked-In" <?php if($book->status == 'Checked-In') {echo('selected');}?>>
                        Checked-In</option>
                    </select>
                  </div>
                  <hr>
                  <div class="col col-md-6">
                      <h3>Arrival: {{ $book->arrival_date }}</h3>
                  </div>
                  <div class="col col-md-6">
                      <h3>Departure: {{ $book->departure_date }}</h3>
                  </div>
                  <hr>
                  <div class="col col-md-12">
                    <h3>Room Id: {{ $book->room_id }}</h3>
                  </div>
                  <hr>
                  <div class="col col-md-6">
                    <label for="adult">Adult: </label><input type="number" name="adult" id="adult" placeholder="Enter number of Adult's" value="{{ $book->adult }}">
                  </div>
                  <div class="col col-md-6">
                    <label for="children">Children: </label><input type="number" name="children" id="children" placeholder="Enter number of Child's" value="{{ $book->children }}">
                  </div>
                  <hr>
                  <div class="col col-md-6">
                    <label for="email">Email: </label> <input type="email" name="email" id="email" placeholder="Enter customer's email" value="{{ $book->email }}" >
                  </div>
                  <div class="col col-md-6">
                    <label for="number">Number: </label> <input type="number" name="number" id="number" placeholder="Enter customer's number" value="{{ $book->number }}" >
                  </div>
                  <hr>
                  <div class="col col-md-6">
                    <label for="stayed">Stayed: </label> <input type="number" name="stayed" id="stayed" placeholder="Enter stayed days" value="{{ $book->stayed }}" >
                  </div>
                  <hr>
                  <div class="col col-md-6">
                    <h3>Total Price: Rs. {{ $book->total_price }}</h3> 
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                type="button"
                class="btn btn-secondary fs-5"
                data-bs-dismiss="modal"
                >
                Close
              </button>
              <button type="submit" class="btn btn-primary fs-5">Save</button>
            </div>
          </div>
        </form>
    </div>
</div>
@endforeach




@endsection



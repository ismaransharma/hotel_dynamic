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
                <h3>Pre Booking - "{{ $searchedPreBooking }}"<h3>
              </div>
            </div>
            <div class="cnct">
                <div class="card">
                  <div class="card-header">
                    <form action="{{ route('getAdminSearchPreBooking') }}" method="GET">
                        <div class="row">
                            <div class="col-md-12 tae">
                              <input type="search" name="searchPreBooking" id="searchPreBooking" class="searchBooking" placeholder="Search by booking id">
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
                                <th>Children</th>
                                <th>Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($PreBookings as $booking)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $booking->booking_id }}</th>
                                    <th>{{ $booking->room_id }}</th>
                                    <th>{{ $booking->name }}</th>
                                    <th>{{ $booking->arrival_date }}</th>
                                    <th>{{ $booking->departure_date }}</th>
                                    <th>{{ $booking->adult }}</th>
                                    <th>{{ $booking->children }}</th>
                                    <th>{{ $booking->number }}</th>
                                    <th>
                                        <button
                                            type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewBookingModal-{{ $booking->id }}"
                                            class="btn btn-primary"
                                        >
                                            <i class="fa-solid fa-eye icons"></i>
                                        </button>
                                        <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#editBookingModal-{{ $booking->id }}" class="btn btn-success">
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
@foreach ($PreBookings as $preBook)
<div
    class="modal fade"
    id="viewBookingModal-{{ $preBook->id }}"
    tabindex="-1"
    aria-labelledby="viewBookingModal-{{ $preBook->id }}Label"
    aria-hidden="true"
    >
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="viewBookingModal-{{ $preBook->booking_id }}Label">View Booking: {{ $preBook->booking_id }}</h5>
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
                <h3>Name: {{ $preBook->name }}</h3>
              </div>
              <div class="col col-md-6">
                <h3>Status: {{ $preBook->status }}</h3>
              </div>
              <hr>
              <div class="col col-md-6">
                <h3>Arrival: {{ $preBook->arrival_date }}</h3>
              </div>
              <div class="col col-md-6">
                <h3>Departure: {{ $preBook->departure_date }}</h3>
              </div>
              <hr>
              <div class="col col-md-6">
                <h3>Room Id: {{ $preBook->room_id }}</h3>
              </div>
              <div class="col col-md-6">
                <h3>Adult: {{ $preBook->adult }}</h3>
              </div>
              <hr>
              <div class="col col-md-6">
                <h3>Children: {{ $preBook->children }}</h3>
              </div>
              <div class="col col-md-6">
                <h3>Email: {{ $preBook->email }}</h3>
              </div>
              <hr>
              <div class="col col-md-6">
                <h3>Number: {{ $preBook->number }}</h3>
              </div>
              <div class="col col-md-6">
                <h3>Stayed: {{ $preBook->stayed }}</h3>
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


<!-- Edit Modal -->
@foreach ($PreBookings as $preBook)
<div
    class="modal fade"
    id="editBookingModal-{{ $preBook->id }}"
    tabindex="-1"
    aria-labelledby="editBookingModal-{{ $preBook->id }}Label"
    aria-hidden="true"
    >
    <div class="modal-dialog">
        <form action="{{ route('postEditPreBooking', $preBook->id) }}" method="POST">
          @csrf
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookingModal-{{ $preBook->booking_id }}Label">View Booking: {{ $preBook->booking_id }}</h5>
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
                  <label for="name">Name: </label><input type="text" name="name" id="name" placeholder="Enter customer's name" value="{{ $preBook->name }}">
                </div>
                <div class="col col-md-6">
                  <label for="status">Status: </label>
                  <select name="status" id="status">
                    <option value="Booked" <?php if($preBook->status == 'Booked') {echo('selected');}?>>
                      Booked</option>
                    <option value="Waiting" <?php if($preBook->status == 'Waiting') {echo('selected');}?>>
                      Waiting</option>
                    <option value="Cancelled" <?php if($preBook->status == 'Cancelled') {echo('selected');}?>>
                      Cancelled</option>
                    <option value="Arrived" <?php if($preBook->status == 'Arrived') {echo('selected');}?>>
                      Arrived</option>
                    <option value="Checked-In" <?php if($preBook->status == 'Checked-In') {echo('selected');}?>>
                      Checked-In</option>
                  </select>
                </div>
                <hr>
                <div class="col col-md-6">
                    <h3>Arrival: {{ $preBook->arrival_date }}</h3>
                </div>
                <div class="col col-md-6">
                    <h3>Departure: {{ $preBook->departure_date }}</h3>
                </div>
                <hr>
                <div class="col col-md-12">
                  <h3>Room Id: {{ $preBook->room_id }}</h3>
                </div>
                <hr>
                <div class="col col-md-6">
                  <label for="adult">Adult: </label><input type="number" name="adult" id="adult" placeholder="Enter number of Adult's" value="{{ $preBook->adult }}">
                </div>
                <div class="col col-md-6">
                  <label for="children">Children: </label><input type="number" name="children" id="children" placeholder="Enter number of Child's" value="{{ $preBook->children }}">
                </div>
                <hr>
                <div class="col col-md-6">
                  <label for="email">Email: </label> <input type="email" name="email" id="email" placeholder="Enter customer's email" value="{{ $preBook->email }}" >
                </div>
                <div class="col col-md-6">
                  <label for="number">Number: </label> <input type="number" name="number" id="number" placeholder="Enter customer's number" value="{{ $preBook->number }}" >
                </div>
                <hr>
                <div class="col col-md-6">
                  <label for="stayed">Stayed: </label> <input type="number" name="stayed" id="stayed" placeholder="Enter stayed days" value="{{ $preBook->stayed }}" >
                </div>
                <hr>
                <div class="col col-md-6">
                  <h3>Total Price: Rs. {{ $preBook->total_price }}</h3> 
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



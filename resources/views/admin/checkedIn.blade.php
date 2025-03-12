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
                <h3>Checked In</h3>
              </div>
            </div>
            <div class="cnct">
                <div class="card">
                  <div class="card-header">
                    <form action="{{ route('getAdminSearchCheckedIn') }}" method="GET">
                      <div class="row">
                          <div class="col-md-12 tae">
                            <input type="search" name="searchCheckedIn" id="searchCheckedIn" class="searchBooking" placeholder="Search by booking id">
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
                        @foreach ($checkedIns as $checked)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $checked->booking_id }}</th>
                                <th>{{ $checked->room_id }}</th>
                                <th>{{ $checked->name }}</th>
                                <th>{{ $checked->arrival_date }}</th>
                                <th>{{ $checked->departure_date }}</th>
                                <th>{{ $checked->adult }}</th>
                                <th>{{ $checked->children }}</th>
                                <th>{{ $checked->number }}</th>
                                <th>
                                    <button
                                      type="button"
                                      data-bs-toggle="modal"
                                      data-bs-target="#viewCheckedInModal-{{ $checked->id }}"
                                      class="btn btn-primary"
                                    >
                                        <i class="fa-solid fa-eye icons"></i>
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
@foreach ($checkedIns as $checked)
<div
    class="modal fade"
    id="viewCheckedInModal-{{ $checked->id }}"
    tabindex="-1"
    aria-labelledby="viewCheckedInModal-{{ $checked->id }}Label"
    aria-hidden="true"
    >
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="viewCheckedInModal-{{ $checked->booking_id }}Label">View Checked In: {{ $checked->booking_id }}</h5>
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
                <h3>Name: {{ $checked->name }}</h3>
              </div>
              <div class="col col-md-6">
                <h3>Status: {{ $checked->status }}</h3>
              </div>
              <hr>
              <div class="col col-md-6">
                <h3>Arrival: {{ $checked->arrival_date }}</h3>
              </div>
              <div class="col col-md-6">
                <h3>Departure: {{ $checked->departure_date }}</h3>
              </div>
              <hr>
              <div class="col col-md-6">
                <h3>Room Id: {{ $checked->room_id }}</h3>
              </div>
              <div class="col col-md-6">
                <h3>Adult: {{ $checked->adult }}</h3>
              </div>
              <hr>
              <div class="col col-md-6">
                <h3>Children: {{ $checked->children }}</h3>
              </div>
              <div class="col col-md-6">
                <h3>Email: {{ $checked->email }}</h3>
              </div>
              <hr>
              <div class="col col-md-6">
                <h3>Number: {{ $checked->number }}</h3>
              </div>
              <div class="col col-md-6">
                <h3>Stayed: {{ $checked->stayed }} Day/s</h3>
              </div>
              <hr>
              <div class="col col-md-6">
                <h3>Total: Rs. {{ $checked->total_price }}</h3>
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





@endsection



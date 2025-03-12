@extends('admin.adminTemplate')
@section('content')
  
<section id="wrapper">
  <div id="dashboard">
    <div class="container-fluid">
      <div class="row contactPage">
        <!-- Contact Us Section -->
        <div class="col-md-12 contactUs my-5">
          <div class="row">
            <div class="col-md-12">
              <div class="header my-3">
                <h3>Contact Us</h3>
              </div>
              <div class="cnct">
                <form action="{{ route('getAdminAddContactUs') }}" method="POST">
                  @csrf
                  <div class="card">
                    <div class="card-body">
                        <input type="number" name="number" value="{{ $contactUs->number }}" placeholder="Enter number"  />
                        <input
                          type="text" name="address"
                          value="{{ $contactUs->address }}" placeholder="Enter address" />
                        <input
                          type="email" name="email"
                          value="{{ $contactUs->email }}" placeholder="Enter email" />
                      </div>
                    <div class="card-footer tae">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
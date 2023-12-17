@extends('layouts/contentLayoutMaster')
@section('title', 'Reservation')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

@endsection
@section('content')
    @include('panels/loading')
    <div class="content-inner mt-5 py-0">
          <div>
               <form method="POST"  enctype="multipart/form-data" id="edit_form" name="product_edit_edit"  action="{{route('reservation.update',$data->id) }}">
               @csrf
               @method('PUT')
                {{-- Food Info  --}}
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"> Edit Reservation</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class="row " >
                                       <div class="form-group col-md-6" >
                                          <label class="form-label" for="first_name">First Name:</label>
                                         <input type="text" class="form-control" name="first_name" value="{{$data->first_name}}" id="fname" placeholder="First Name">
                                      </div>
                                      <div class="form-group col-md-6" >
                                        <label class="form-label" for="last_name">Last Name:</label>
                                       <input type="text" class="form-control" name="last_name" value="{{$data->last_name}}" id="lname" placeholder="Last Name">
                                    </div>
                                    </div>
                                    <div class="row " >
                                        <div class="form-group col-md-6" >
                                           <label class="form-label" for="email">Email:</label>
                                          <input type="text" class="form-control" name="email" value="{{$data->email}}" id="email" placeholder="Email">
                                       </div>
                                       <div class="form-group col-md-6" >
                                         <label class="form-label" for="phone_number">Phone Number:</label>
                                        <input type="text" class="form-control" name="phone_number" value="{{$data->phone_number}}" id="phone_number" placeholder="Phone Number">
                                     </div>
                                     </div>
                                     <div class="row " >
                                        <div class="form-group col-md-6" >
                                           <label class="form-label" for="res_date">Reservation Date:</label>
                                          <input type="datetime-local" class="form-control" name="res_date" value="{{$data->res_date}}" id="res_date" >
                                       </div>
                                       <div class="form-group col-md-6" >
                                         <label class="form-label" for="guest_number">Guest Number:</label>
                                        <input type="text" class="form-control" name="guest_number" value="{{$data->guest_number}}" id="guest_number" placeholder="Guest Number">
                                     </div>
                                     </div>
                                     <div class="row " >
                                        <div class="form-group col-md-6" >
                                           <label class="form-label" for="table_id">Table:</label>
                                          <select name="table_id" id="table_id" class="form-select">
                                            <option value="" selected disabled>Select Table</option>
                                            @foreach ($tables as $table)
                                            <option value="{{ $table->id }}">{{ $table->name }}
                                                    ({{ $table->guest_number }} Guest)</option>
                                            @endforeach
                                          </select>
                                       </div>
                                     </div>
                                     <hr>
                                     <div class="row " >
                                         <div class="form-group col-md-6" >
                                          <button type="submit" id="submit_btn_real" class="btn btn-primary">Update</button>
                                       </div>
                                       </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page-script')
    {{-- <script src="{{asset('js/module/auth.js')}}"></script> --}}
    <script src="{{ asset('js/core/libs.min.js') }}"></script>
    <script src="{{ asset('js/core/external.min.js') }}"></script>
    <script src="{{ asset('js/charts/widgetcharts.js') }}"></script>
    <script src="{{ asset('vendor/Leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('js/charts/vectore-chart.js') }}"></script>
    <script src="{{ asset('js/charts/dashboard.js') }}"></script>
    <script src="{{ asset('js/charts/admin.js') }}"></script>
    <script src="{{ asset('js/fslightbox.js') }}"></script>
    <script src="{{ asset('vendor/gsap/gsap.min.js') }}"></script>
    <script src="{{ asset('vendor/gsap/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('js/animation/gsap-init.js') }}"></script>
    <script src="{{ asset('js/stepper.js') }}"></script>
    <script src="{{ asset('js/form-wizard.js') }}"></script>
    <script src="{{ asset('js/circle-progress.js') }}"></script>
    <script src="{{ asset('js/prism.mini.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/moment.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

@endsection


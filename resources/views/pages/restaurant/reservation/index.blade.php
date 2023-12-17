@extends('layouts/contentLayoutMaster')
@section('title', 'Reservation')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        /* tbody td{
            text-align: center;
        } */
    </style>
    <style>
        .overlay-model {
                background-color: rgb(44 38 38 / 85%);
                border-radius: 20px;
            }

            .overlay-model h5 {
                color: #FFF !important;
            }
            .input-color::-webkit-input-placeholder{
                color:var(--white);
            }
    </style>
@endsection
@section('content')
    @include('panels/loading')
    @include('notification')
    <div class="content-inner mt-5 py-0">
        <div>
       <div class="row">
          <div class="col-sm-12">
             <div class="card">
                <div class="card-header d-flex justify-content-between">
                   <div class="header-title">
                      <h4 class="card-title">Reservation List</h4>
                   </div>
                </div>
                <div class="card-body px-0">
                   <div class="table-responsive">
                      <table id="dataTableList" class="table table-striped" role="grid">
                         <thead>
                            <tr class="ligth">
                               <th >SL</th>
                               <th >Name</th>
                               <th >Email</th>
                               <th >Phone Number</th>
                               <th >Guests</th>
                               <th >Reservation Date</th>
                               <th >From </th>
                               <th >To</th>
                               <th >Table Name</th>
                               <th >Status</th>
                               {{-- <th >Action</th> --}}
                            </tr>
                         </thead>
                      </table>
                   </div>
                </div>
             </div>
             <!-- Accept model Start -->
             @foreach ($reservation as $reservations)
             <div class="modal fade bd-example-modal-xl" id="exampleModalCenter{{ $reservations->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                   <div class="modal-content" style="background-image: url({{ asset('images/modal_images/reservation1.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="overlay-model">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">Approve Reservation</h5>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('restro.approve_mail') }}" id="validation">
                            @csrf
                           <div class="row">
                              <div class="form-group col-md-4">
                                 <h6 class="form-label" for="fname" style="color:white">Name:</h6>
                                 <p style="color: #e1cccc;">{{ $reservations->first_name }} {{ $reservations->last_name }}</p>
                              </div>
                              <div class="form-group col-md-4">
                                <h6 class="form-label" for="fname" style="color:white">Phone Number:</h6>
                                <p style="color: #e1cccc;">{{ $reservations->phone_number }}</p>
                             </div>
                             <div class="form-group col-md-4">
                                <h6 class="form-label" for="fname" style="color:white">Email:</h6>
                                <p style="color: #e1cccc;">{{ $reservations->email }}</p>
                             </div>
                           </div>
                           <div class="row">
                            <div class="form-group col-md-4">
                                <h6 class="form-label" for="fname" style="color:white">Guests:</h6>
                                <p style="color: #e1cccc;">{{ $reservations->guest_number }}</p>
                             </div>
                             <div class="form-group col-md-4">
                               <h6 class="form-label" for="fname" style="color:white">Reservation Date:</h6>
                               <p style="color: #e1cccc;">{{ date('d M Y', strtotime($reservations->res_date)) }}</p>
                            </div>
                            <div class="form-group col-md-4">
                               <h6 class="form-label" for="fname" style="color:white">From:</h6>
                               <p style="color: #e1cccc;">{{ $reservations->to_time }}</p>
                            </div>
                           </div>
                           <div class="row">
                            <div class="form-group col-md-4">
                                <h6 class="form-label" for="fname" style="color:white">To:</h6>
                                <p style="color: #e1cccc;">{{ $reservations->from_time }}</p>
                             </div>
                             <div class="form-group col-md-4">
                               <h6 class="form-label" for="fname" style="color:white">Table Name:</h6>
                               <p style="color: #e1cccc;">{{ $reservations->table->name }}</p>
                               <input type="text" name="reservation_id" value="{{ $reservations->id }}" hidden>
                            </div>
                           </div>
                        </div>
                        <div class="modal-footer" style="justify-content: center !important; border-top:0 !important">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: white; color:#FF6A00;">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-paper-plane"></i> Send Mail</button>
                        </div>
                    </form>
                   </div>
                </div>
                </div>
             </div>
             @endforeach
             <!-- Accept model End -->
             <!-- Reject model Start -->
             @foreach ($reservation as $key => $reservations)
             <div class="modal fade bd-example-modal-xl" id="RejectexampleModalCenter{{ $reservations->id }}" tabindex="-1" role="dialog" aria-labelledby="RejectexampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                   <div class="modal-content" style="background-image: url({{ asset('images/modal_images/reservation1.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="overlay-model">
                      <div class="modal-header">
                         <h5 class="modal-title" id="RejectexampleModalCenterTitle">Reject Reservation</h5>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('restro.reject_mail') }}" id="validation{{ $key + 1 }}">
                            @csrf
                           <div class="row">
                              <div class="form-group col-md-4">
                                 <h6 class="form-label" for="fname" style="color: white">Name:</h6>
                                 <p style="color: #e1cccc;">{{ $reservations->first_name }} {{ $reservations->last_name }}</p>
                              </div>
                              <div class="form-group col-md-4">
                                <h6 class="form-label" for="fname" style="color: white">Phone Number:</h6>
                                <p style="color: #e1cccc;">{{ $reservations->phone_number }}</p>
                             </div>
                             <div class="form-group col-md-4">
                                <h6 class="form-label" for="fname" style="color: white">Email:</h6>
                                <p style="color: #e1cccc;">{{ $reservations->email }}</p>
                             </div>
                           </div>
                           <div class="row">
                            <div class="form-group col-md-4">
                                <h6 class="form-label" for="fname" style="color: white">Guests:</h6>
                                <p style="color: #e1cccc;">{{ $reservations->guest_number }}</p>
                             </div>
                             <div class="form-group col-md-4">
                               <h6 class="form-label" for="fname" style="color: white">Reservation Date:</h6>
                               <p style="color: #e1cccc;">{{ date('d M Y', strtotime($reservations->res_date)) }}</p>
                            </div>
                            <div class="form-group col-md-4">
                               <h6 class="form-label" for="fname" style="color: white">From:</h6>
                               <p style="color: #e1cccc;">{{ $reservations->to_time }}</p>
                            </div>
                           </div>
                           <div class="row">
                            <div class="form-group col-md-4">
                                <h6 class="form-label" for="fname" style="color: white">To:</h6>
                                <p style="color: #e1cccc;">{{ $reservations->from_time }}</p>
                             </div>
                             <div class="form-group col-md-4">
                               <h6 class="form-label" for="fname" style="color: white">Table Name:</h6>
                               <p style="color: #e1cccc;">{{ $reservations->table->name }}</p>
                               <input type="text" name="reservation_id" value="{{ $reservations->id }}" hidden>
                            </div>
                            <div class="form-group col-md-4">
                                <h6 class="form-label" for="fname" style="color: white">Reject Reason:</h6>
                                <textarea name="reject_reason" id="" cols="4" rows="4" class="form-control" placeholder="Reject Reason"></textarea>
                                <input type="text" name="reservation_id" value="{{ $reservations->id }}" hidden>
                             </div>
                           </div>
                        </div>
                        <div class="modal-footer" style="justify-content: center !important; border-top:0 !important">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: white; color:#FF6A00;">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-paper-plane"></i> Send Mail</button>
                        </div>
                    </form>
                   </div>
                </div>
                </div>
             </div>
             @endforeach
             <!-- Reject model End -->

          </div>
       </div>
    </div>
    </div>
@endsection
@section('page-script')
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script>
    function deleteRecord(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085D6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('del' + id).click();
            } else
                return false;
        });
    }
</script>
    <script>
        reservationlistindex = "{{ route('reservation.index') }}";
    </script>
    <script>
        reservationstatus = "{{ route('restro.reservation_status') }}"
    </script>
    <script src="{{ asset('js/scripts/restaurant/reservation.js') }}"></script>
    @foreach ($reservation as $key => $reservations)
    <script>
        $('#validation{{ $key + 1 }}').validate({
            rules: {
                reject_reason: {
                    required: true,
                },
            },
            messages: {
                reject_reason: {
                    required: "This Reject Reason field is required",
                },
            },
        });
    </script>
    @endforeach
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
@endsection

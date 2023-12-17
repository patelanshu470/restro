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
                      <h4 class="card-title">Transaction List</h4>
                   </div>
                </div>
                <div class="card-body px-0">
                   <div class="table-responsive">
                      <table id="dataTableList" class="table table-striped" role="grid">
                         <thead>
                            <tr class="ligth">
                               <th >SL</th>
                               <th >Oder ID</th>
                               <th >Payment ID</th>
                               <th >Amount</th>
                               <th >Payment Status</th>
                               <th >Action</th>
                            </tr>
                         </thead>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    </div>
@endsection
@section('page-script')
    <script>
        transectionlistindex = "{{ route('restro.transection') }}";
    </script>
    <script src="{{ asset('js/scripts/restaurant/transection.js') }}"></script>
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

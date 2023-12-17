@extends('layouts/contentLayoutMaster')
@section('title', 'Orders')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        tbody td{
            text-align: center;
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
                      <h4 class="card-title">All Orders List</h4>
                   </div>
                   <div class="header-title">
                 </div>
                </div>
                <div class="card-body px-0">
                   <div class="table-responsive">
                      <table id="dataTableList" class="table table-striped" role="grid">
                         <thead>
                            <tr class="ligth">
                               <th class="text-center">SL</th>
                               <th class="text-center">Order ID</th>
                               <th class="text-center">Customer Information</th>
                               <th class="text-center">Restaurant</th>
                               <th class="text-center">Total Amount</th>
                               <th class="text-center">Order Status</th>
                               <th class="text-center">Action</th>
                            </tr>
                         </thead>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <a href="javascript:void(0)" id="check" style="display: none;">click here</a>
       <a href="{{ route('admin.order.index') }}" id="index_page" style="display: none;">click here</a>
       <audio id="audio" src="{{ asset('audio/notification.mp3') }}" preload="auto">click me</audio>
    </div>
    </div>
@endsection

@section('page-script')
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        {{-- <script>
            checkneworder = "{{ route('admin.order.checkneworder') }}";
        </script>
        <script>
            readneworder = "{{ route('admin.order.readneworder') }}";
        </script> --}}
    <script>
        orderlistindex = "{{ route('admin.order.index') }}";
    </script>
    <script src="{{asset('js/scripts/admin/order.js')}}"></script>
    {{-- <script src="{{asset('js/scripts/admin/neworder.js')}}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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

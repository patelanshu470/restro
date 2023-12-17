@extends('layouts/contentLayoutMaster')
@section('title', 'Restaurant')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        #restro_image{
            height:70px;
            width:100px;
            border-radius:5px;
        }
        .select2-container--default .select2-selection--single{
            height: 45px;
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.75;
            color: #959895;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #E3E1E1;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 1.25rem;
            box-shadow: 0 0 0 0;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            color: #959895;
        }
        .select2-selection__arrow{
            display: none;
        }
        option:hover{
            color:#ea6a12;
        }
    </style>
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')
    <div class="content-inner mt-5 py-0">
        <div class="">
       <div class="row">
          <div class="col-sm-12">
             <div class="card">
                <div class="card-header d-flex justify-content-between">
                   <div class="header-title">
                      <h4 class="card-title">Restaurant List</h4>
                   </div>
                   <div class="header-title">
                    <a href="{{ route('restaurant.create') }}" class="btn btn-primary rounded-pill mt-2"><i class="fa-solid fa-plus"></i> Add </a>
                 </div>
                </div>
                <div class="card-body px-0">
                   <div class="table-responsive">
                    <div class="row" style="margin-left: 10px; margin-right: 15px;">
                        <div class="form-group col-md-6">
                           <label class="form-label" for="restaurant_name">Name:</label>
                           <input type="text" class="form-control" name="restaurant_name" id="restaurant_name"
                                                    placeholder="Restaurant Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="name">Status:</label>
                            <select name="status" class="selectpicker form-control" id="status">
                             <option selected disabled>Select Status</option>
                             <option value="1">Active</option>
                             <option value="0">Deactive</option>
                          </select>
                         </div>
                     </div>
                      <table id="dataTableList" class="table table-striped" role="grid">
                         <thead>
                            <tr class="ligth">
                               <th>ID</th>
                               <th>Name</th>
                               <th>Contact</th>
                               <th>Email</th>
                               <th>Status</th>
                               <th>Action</th>
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
    restaurantstatus = "{{ route('restaurantstatus') }}";
</script>
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script>
function deleteRecord(id) {
  Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#EA6A12",
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
        restaurantlistindex = "{{ route('restaurant.index') }}";
    </script>
    <script src="{{asset('js/scripts/admin/restaurant.js')}}"></script>
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

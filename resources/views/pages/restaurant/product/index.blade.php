@extends('layouts/contentLayoutMaster')
@section('title', 'Product')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
                      <h4 class="card-title">Product List</h4>
                   </div>
                   <div class="header-title">
                    <a href="{{route('product.create')}}" class="btn btn-primary rounded-pill mt-2"><i class="fa-solid fa-plus"></i> Add</a>
                 </div>
                </div>
                <div class="card-body px-0">
                   <div class="table-responsive">
                        <div class="row" style="margin-left: 10px; margin-right: 15px;">
                            <div class="form-group col-md-3">
                            <label class="form-label" for="name">Name:</label>
                            <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Product Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="category">Category:</label>
                                <select name="category" class="selectpicker form-control" id="category">
                                <option selected disabled>Select Category</option>
                                @foreach ($category as $categories)
                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="type">Type:</label>
                                <select name="type" class="selectpicker form-control" id="type">
                                 <option selected disabled>Select Type</option>
                                 <option value="veg">Veg</option>
                                 <option value="non_veg">Non Veg</option>
                              </select>
                             </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="name">Status:</label>
                                <select name="status" class="selectpicker form-control" id="status">
                                <option selected disabled>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            </div>
                        </div>
                      <table id="dataTableList" class="table datatables-basic" role="grid">
                         <thead>
                            <tr class="ligth">
                               <th >ID</th>
                               <th >Name</th>
                               <th >Category</th>
                               <th >Selling Price</th>
                               <th >Status</th>
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
    restroproductstatus = "{{ route('restro.productstatus') }}";
</script>
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script>
function deleteRecord(id) {
  Swal.fire({
      title: 'Confirmation!',
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
        projectlistindex = "{{ route('product.index') }}";
    </script>
    <script src="{{ asset('js/scripts/restaurant/product.js') }}"></script>
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

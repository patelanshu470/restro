@extends('layouts/contentLayoutMaster')
@section('title', 'Food Category')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
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
                      <h4 class="card-title">Food Categories List</h4>
                   </div>
                   <div class="header-title">
                    <a href="#" role="button" class="btn btn-primary rounded-pill mt-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa-solid fa-plus"></i> Add</a>
                 </div>
                </div>
                <div class="card-body px-0">
                   <div class="table-responsive">
                       <table id="dataTableList" class="datatables-basic table" role="grid">
                          <div class="row" style="margin-left: 20px; margin-right: 20px;">
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="name">Name:</label>
                                 <input type="text" class="form-control" name="category" id="category"
                                                    placeholder="Category Name">
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
                         <thead>
                            <tr class="ligth">
                               <th>#</th>
                               <th>Name</th>
                               <th>Status</th>
                               <th >Action</th>
                            </tr>
                         </thead>
                      </table>
                   </div>
                </div>
             </div>
             <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">Create Food Category</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('category.store') }}" id="validation">
                            @csrf
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="fname">Name:</label>
                                 <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                   </div>
                </div>
             </div>
             {{-- Edit Model.... --}}
             @foreach ($category as $categories)
             <div class="modal fade" id="EditModalCenter{{ $categories->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">Edit Food Category</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('category.update',$categories->id) }}" id="edit_category{{ $categories->id }}">
                            @csrf
                            @method('PUT')
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="fname">Name:</label>
                                 <input type="text" class="form-control" name="name" value="{{ $categories->name }}" id="name" placeholder="Name">
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                   </div>
                </div>
             </div>
             @endforeach
          </div>
       </div>
    </div>
    <a href="javascript:void(0)" id="check" style="display: none;">click here</a>
    <a href="{{ route('admin.order.index') }}" id="index_page" style="display: none;">click here</a>
    <audio id="audio" src="{{ asset('audio/notification.mp3') }}" preload="auto">click me</audio>
    </div>
@endsection
@section('page-script')
    <script>
        categorystatus = "{{ route('changecategory') }}";
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
@foreach ($category as $categories)
<script>
    $('#edit_category{{ $categories->id }}').validate({
    rules: {
        name: {
          required: true
        },

    },
    messages: {
      name: {
          required: "This name field is required",
      },

    }
});
</script>
@endforeach
    <script>
        categorylistindex = "{{ route('category.index') }}";
    </script>
    {{-- <script>
        checkneworder = "{{ route('admin.order.checkneworder') }}";
    </script>
    <script>
        readneworder = "{{ route('admin.order.readneworder') }}";
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="{{asset('js/scripts/admin/neworder.js')}}"></script> --}}
    <script src="{{asset('js/scripts/admin/category.js')}}"></script>
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

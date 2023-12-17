@extends('layouts/contentLayoutMaster')
@section('title', 'Food Sub-Category')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        .overlay-model {
                background-color: rgb(48 44 44 / 62%);
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
                      <h4 class="card-title">Food SubCategory List</h4>
                   </div>
                   <div class="header-title">
                    <a href="" role="button" class="btn btn-primary rounded-pill mt-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa-solid fa-plus"></i> Add</a>
                 </div>
                </div>
                <div class="card-body px-0">
                   <div class="table-responsive">
                      <table id="dataTableList" class="table table-striped" role="grid">
                        <div class="row" style="margin-left: 20px; margin-right: 20px;">
                            <div class="form-group col-md-4">
                               <label class="form-label" for="name">Name:</label>
                               <input type="text" class="form-control" name="subcategory" id="subcategory"
                                                    placeholder="Subcategory Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="name">Category:</label>
                                <select name="category" class="selectpicker form-control" id="category">
                                 <option selected disabled>Select Category</option>

                                 @foreach ($category as $categories)
                                 <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                 @endforeach
                              </select>
                             </div>
                            <div class="form-group col-md-4">
                              <label class="form-label" for="status">Status:</label>
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
                               <th>Category</th>
                               <th>Status</th>
                               <th >Action</th>
                            </tr>
                         </thead>
                      </table>
                   </div>
                </div>
             </div>
             {{-- Add Model... --}}
             <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content" style="background-image: url({{ asset('images/modal_images/subcategory.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="overlay-model">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">Create Food SubCategory</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('subcategory.store') }}" id="validation">
                            @csrf
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="fname" style="color:white">Name:</label>
                                 <input type="text" class="form-control input-color" name="name" id="name" placeholder="Name" style="background: transparent;color: #fff">
                              </div>
                              <div class="form-group col-md-12">
                                <label class="form-label" style="color:white">Category:</label>
                                 <select name="category_id" class="selectpicker form-control" data-style="py-0" style="background: transparent;color: #fff">
                                    <option selected disabled style="color: #a7a5a5">Select Category</option>

                                    @foreach ($category as $categories)
                                    <option value="{{ $categories->id }}" style="color: #a7a5a5">{{ $categories->name }}</option>
                                    @endforeach
                                 </select>
                             </div>
                           </div>
                        </div>
                        <div class="modal-footer" style="justify-content: center !important; border-top:0 !important">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: white; color:#FF6A00;">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                   </div>
                </div>
                </div>
             </div>

             {{-- Edit Model.... --}}
            @foreach ($subcategory as $subcategories)
             <div class="modal fade" id="EditModalCenter{{ $subcategories->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content" style="background-image: url({{ asset('images/modal_images/subcategory.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="overlay-model">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">Edit Food SubCategory</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('subcategory.update',$subcategories->id) }}" id="edit_subcategory{{ $subcategories->id }}">
                            @csrf
                            @method('PUT')
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="fname" style="color:white">Name:</label>
                                 <input type="text" class="form-control " name="name" value="{{ $subcategories->name }}" id="name" placeholder="Name" style="background: transparent;color: #fff;">
                              </div>
                              <div class="form-group col-md-12">
                                <label class="form-label" style="color:white">Category:</label>
                                 <select name="category_id" class="selectpicker form-control" data-style="py-0" style="background: transparent;color: #fff;">
                                    <option disabled style="color: #a7a5a5">Select Category</option>
                                    @foreach ($category as $categories)
                                    <option value="{{ $categories->id }}" {{($categories->id == $subcategories->category_id ) ? 'Selected' : ''}} style="color: #686464">{{ $categories->name }}</option>
                                    @endforeach
                                 </select>
                             </div>
                           </div>
                        </div>
                        <div class="modal-footer" style="justify-content: center !important; border-top:0 !important">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: white; color:#FF6A00;">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                   </div>
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
    subcategorystatus = "{{ route('changesubcategory') }}";
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
@foreach ($subcategory as $subcategories)
<script>
    $('#edit_subcategory{{ $subcategories->id }}').validate({
    rules: {
        name: {
          required: true
        },
        category_id: {
            required: true
          },

    },
    messages: {
      name: {
          required: "This name field is required",
      },
      category_id: {
        required: "This Category field is required",
    },

    }
});
</script>
@endforeach
<script>
    subcategorylistindex = "{{ route('subcategory.index') }}";
</script>
{{-- <script>
    checkneworder = "{{ route('admin.order.checkneworder') }}";
</script>
<script>
    readneworder = "{{ route('admin.order.readneworder') }}";
</script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="{{asset('js/scripts/admin/neworder.js')}}"></script> --}}
<script src="{{asset('js/scripts/admin/subcategory.js')}}"></script>
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

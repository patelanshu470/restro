@extends('layouts/contentLayoutMaster')
@section('title', 'Addons')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
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
        <div>
       <div class="row">
          <div class="col-sm-12">
             <div class="card">
                <div class="card-header d-flex justify-content-between">
                   <div class="header-title">
                      <h4 class="card-title">Addons List</h4>
                   </div>
                   <div class="header-title">
                    <a href="#" class="btn btn-primary rounded-pill mt-2" role="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa-solid fa-plus"></i> Add</a>
                 </div>
                </div>
                <div class="card-body px-0">
                   <div class="table-responsive">
                    <div class="row" style="margin-left: 10px; margin-right: 15px;">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="restaurant_id">Name:</label>
                            <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Addons Name">
                         </div>
                        <div class="form-group col-md-4">
                           <label class="form-label" for="restaurant_id">Restaurant:</label>
                           <select name="restaurant_id" class="selectpicker form-control select2" id="restaurant_id">
                            <option selected disabled>Select Restaurant</option>
                            @foreach ($restaurant as $restaurants)
                            <option value="{{ $restaurants->id }}">{{ $restaurants->restaurant_name }}</option>
                            @endforeach
                         </select>
                        </div>
                        <div class="form-group col-md-4">
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
                               <th>#</th>
                               <th>Name</th>
                               <th>Restaurant</th>
                               <th>Price</th>
                               <th>Status</th>
                               <th >Action</th>
                            </tr>
                         </thead>
                      </table>
                   </div>
                </div>
             </div>
             {{-- Create Model... --}}
             <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('addons.store') }}" id="validation">
                            @csrf
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="fname">Name:</label>
                                 <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                              </div>
                              <div class="form-group col-md-12">
                                <label class="form-label">Restaurant:</label>
                                 <select name="restaurant_id" class="selectpicker form-control" data-style="py-0">
                                    <option selected disabled>Select Restaurant</option>
                                    @foreach ($restaurant as $restaurants)
                                    <option value="{{ $restaurants->id }}">{{ $restaurants->restaurant_name }}</option>
                                    @endforeach
                                 </select>
                             </div>
                             <div class="form-group col-md-12">
                                <label class="form-label" for="price">Price:</label>
                                <input type="number" class="form-control" name="price" id="price" placeholder="Price">
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
             {{-- Edit Model... --}}
             @foreach ($addon as $addons)
             <div class="modal fade" id="EditModalCenter{{ $addons->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('addons.update',$addons->id) }}" id="edit_addons{{ $addons->id }}">
                            @csrf
                            @method('PUT')
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="fname">Name:</label>
                                 <input type="text" class="form-control" name="name" value="{{ $addons->name }}" id="name" placeholder="Name">
                              </div>
                              <div class="form-group col-md-12">
                                <label class="form-label">Restaurant:</label>
                                 <select name="restaurant_id" class="selectpicker form-control" data-style="py-0">
                                    <option>Select Restaurant</option>
                                    @foreach ($restaurant as $restaurants)
                                    <option value="{{ $restaurants->id }}" {{($restaurants->id == $addons->restaurant_id ) ? 'Selected' : ''}}>{{ $restaurants->restaurant_name }}</option>
                                    @endforeach
                                 </select>
                             </div>
                             <div class="form-group col-md-12">
                                <label class="form-label" for="price">Price:</label>
                                <input type="number" class="form-control" value="{{ $addons->price }}" name="price" id="price" placeholder="Price">
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
          <a href="javascript:void(0)" id="check" style="display: none;">click here</a>
          <a href="{{ route('admin.order.index') }}" id="index_page" style="display: none;">click here</a>
          <audio id="audio" src="{{ asset('audio/notification.mp3') }}" preload="auto">click me</audio>
       </div>
    </div>
    </div>
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var select = $('.select2');
    select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
    dropdownAutoWidth: true,
    dropdownParent: $this.parent()
    });
    });
</script>
<script type="text/javascript">
    $('#restaurant_id').on('change',function(){
    $value=$(this).val();
    $.ajax({
    type : 'get',
    url : "{{route('addonssearch')}}",
    data:{'search':$value},
    success:function(data){
        console.log(data);
    $('tbody').html(data);
    }
    });
    })
    </script>
    <script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
<script>
    addonsstatus = "{{ route('addonsstatus') }}";
</script>
<script src="{{ asset('js/scripts/admin/addons.js') }}"></script>
<script>
    addonslistindex = "{{ route('addons.index') }}";
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
    confirmButtonText: "Yes, delete it!",ButtonText: "Yes, delete it!",
  }).then((result) => {
      if (result.isConfirmed) {
          document.getElementById('del' + id).click();
      } else
          return false;
  });
}
</script>

@foreach ($addon as $addons)
<script>
$('#edit_addons{{ $addons->id }}').validate({
    rules: {
        name: {
        required: true
        },
        restaurant_id: {
            required: true
        },
        price: {
            required: true
        },

    },
    messages: {
    name: {
        required: "This name field is required",
    },
    restaurant_id: {
        required: "This Restaurant field is required",
    },
    price: {
        required: "This Restaurant field is required",
    },

    }
});
</script>
@endforeach
{{-- <script>
    checkneworder = "{{ route('admin.order.checkneworder') }}";
</script>
<script>
    readneworder = "{{ route('admin.order.readneworder') }}";
</script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="{{asset('js/scripts/admin/neworder.js')}}"></script> --}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    {{-- <script src="{{ asset('js/scripts/admin/addons.js') }}"></script> --}}
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

@extends('layouts/contentLayoutMaster')
@section('title', 'Table')

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
                      <h4 class="card-title">Table List</h4>
                   </div>
                   <div class="header-title">
                    <a href="#" class="btn btn-primary rounded-pill mt-2" role="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa-solid fa-plus"></i> Add</a>
                 </div>
                </div>
                <div class="card-body px-0">
                   <div class="table-responsive">
                      <table id="dataTableList" class="table table-striped" role="grid">
                         <thead>
                            <tr class="ligth">
                                <th class="text-center">SL</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Guest Number</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                         </thead>
                      </table>
                   </div>
                </div>
             </div>
             {{-- Create Model... --}}
             <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content" style="background-image: url({{ asset('images/modal_images/table.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="overlay-model">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('table.store') }}" id="validation">
                            @csrf
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="fname" style="color:white">Name:</label>
                                 <input type="text" class="form-control input-color" name="name" id="name" placeholder="Table Name" style="background: transparent;color: #fff;">
                              </div>
                              <div class="form-group col-md-12">
                                <label class="form-label" for="fname" style="color:white">Guest Number:</label>
                                <input type="number" class="form-control input-color" name="guest_number" id="guest_number" placeholder="Guest Number" style="background: transparent;color: #fff;">
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
             {{-- Edit Model... --}}
             @foreach ($table as $tables)
             <div class="modal fade" id="EditModalCenter{{ $tables->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content" style="background-image: url({{ asset('images/modal_images/table.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="overlay-model">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('table.update',$tables->id) }}" id="edit_city{{ $tables->id }}">
                            @csrf
                            @method('PUT')
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="fname" style="color:white">Name:</label>
                                 <input type="text" class="form-control input-color" name="name" value="{{ $tables->name }}" id="name" placeholder="Name" style="background: transparent;color: #fff;">
                              </div>
                              <div class="form-group col-md-12">
                                <label class="form-label" for="fname" style="color:white">Guest Number:</label>
                                <input type="number" class="form-control input-color" name="guest_number" value="{{ $tables->guest_number }}" id="guest_number{{$tables->id}}" placeholder="Guest Number" style="background: transparent;color: #fff;">
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
             @endforeach
          </div>
       </div>
    </div>
    </div>
@endsection

@section('page-script')



{{-- for stoping user to entering -ve no  --}}
<script>
   $(document).ready(function() {
     $('#quantity,#guest_number').on('input', function() {
       var value = parseFloat($(this).val());
       if (isNaN(value) || value < 0) {
         $(this).val('');
       }
     });
   });
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

@foreach ($table as $tables)

{{-- for stoping user to entering -ve no  --}}
<script>
   $(document).ready(function() {
     $('#quantity{{$tables->id}},#guest_number{{$tables->id}}').on('input', function() {
       var value = parseFloat($(this).val());
       if (isNaN(value) || value < 0) {
         $(this).val('');
       }
     });
   });
 </script>


<script>
$('#edit_city{{ $tables->id }}').validate({
    rules: {
        name: {
        required: true
        },
        state_id: {
            required: true
        },
    },
    messages: {
    name: {
        required: "This name field is required",
    },
    state_id: {
        required: "This state field is required",
    },

    }
});
</script>
@endforeach
    <script>
        tablelistindex = "{{ route('table.index') }}";
    </script>
    <script src="{{ asset('js/scripts/restaurant/table.js') }}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
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

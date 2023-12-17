@extends('layouts/contentLayoutMaster')
@section('title', 'State')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        .overlay-model {
            background-color: rgba(0, 0, 0, 0.53);
            border-radius: 20px;
        }
        .overlay-model h5 {
            color: #FFF !important;
        }
        .input-color::-webkit-input-placeholder{
            color:var(--white);
        }
        /* .select-state{
            color: #fff;
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
                      <h4 class="card-title">State List</h4>
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
                               <th>#</th>
                               <th>Name</th>
                               <th>Country</th>
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
                   <div class="modal-content" style="background-image: url({{ asset('images/modal_images/state.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="overlay-model">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">State Create</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <form name="add_states" method="POST" action="{{ route('state.store') }}" id="add_state" >
                            @csrf
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="name" style="color:white">Name:</label>
                                 <input type="text" class="form-control input-color" name="name" id="name" placeholder="Name" style="background: transparent;color: #fff;">
                                 <span id="error" style="color: red"></span>
                              </div>
                              <div class="form-group col-md-12">
                                <label class="form-label" style="color:white">Country:</label>
                                 <select name="country_id" class="selectpicker form-control" data-style="py-0" style="background: transparent;color: #fff">
                                    <option selected disabled class="select-state" style="color: #a7a5a5">Select Country</option>
                                    @foreach ($country as $countries)
                                    <option value="{{ $countries->id }}" style="color: #686464">{{ $countries->name }}</option>
                                    @endforeach
                                 </select>
                                 <span id="errors" style="color: red"></span>
                             </div>
                           </div>
                        </div>
                        <div class="modal-footer" style=" justify-content: center !important; border-top:0 !important">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: white; color:#FF6A00;">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                   </div>
                </div>
                </div>
             </div>
             {{-- Edit Model... --}}
             @foreach ($state as $states)
             <div class="modal fade" id="EditModalCenter{{ $states->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content" style="background-image: url({{ asset('images/modal_images/state.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="overlay-model">
                      <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalCenterTitle">State Edit</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                      </div>
                      <div class="modal-body">
                        <form name="edit_state" method="POST" action="{{ route('state.update',$states->id) }}" id="edit_state{{ $states->id }}">
                            @csrf
                            @method('PUT')
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="name" style="color:white">Name:</label>
                                 <input type="text" class="form-control input-color" name="name" value="{{ $states->name }}" id="name{{$states->id}}" placeholder="Name" style="background: transparent;color: #fff;">
                              </div>
                              <div class="form-group col-md-12">
                                <label class="form-label" style="color:white">Country:</label>
                                 <select name="country_id" id="country_id" class="selectpicker form-control" data-style="py-0" style="background: transparent;color: #fff">
                                    <option disabled style="color: #a7a5a5">Select Country</option>
                                    @foreach ($country as $countries)
                                    <option value="{{ $countries->id }}" {{($countries->id == $states->country_id ) ? 'Selected' : ''}} style="color: #a7a5a5">{{ $countries->name }}</option>
                                    @endforeach
                                 </select>
                             </div>
                           </div>
                        </div>
                        <div class="modal-footer" style=" justify-content: center !important; border-top:0 !important">
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
{{-- <script src="{{asset('js/scripts/admin/state.js')}}"></script> --}}
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
@foreach ($state as $states)
<script>
    $("#edit_state{{ $states->id }}").validate({
    rules: {
        name: {
            required: true,
        },
        country_id: {
            required: true,
        },
    },
    messages: {
        name: {
            required: "This Name field is required",
        },
        country_id: {
            required: "This Country field is required",
        },
    },
    submitHandler: function(form) {
        form.submit();
    }
});
</script>
@endforeach
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    statelistindex = "{{ route('state.index') }}";
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/scripts/admin/state.js') }}"></script>
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



@foreach ($state as $states)
{{-- attention:  --}}
<script>
    $(document).ready(function() {
        $('#name{{$states->id}}').keypress(function(event) {
            var inputValue = event.which;
            // allow letters and whitespaces only
            if (!(inputValue >= 65 && inputValue <= 90) && !(inputValue >= 97 && inputValue <= 122) && !
                (inputValue == 32)
            ) {
                event.preventDefault();
            }
        });
    });
</script>
@endforeach

<script>
$(document).ready(function() {
    $('#name').keypress(function(event) {
        var inputValue = event.which;
        // allow letters and whitespaces only
        if (!(inputValue >= 65 && inputValue <= 90) && !(inputValue >= 97 && inputValue <= 122) && !
            (inputValue == 32)) {
            event.preventDefault();
        }
    });
});
</script>


@endsection

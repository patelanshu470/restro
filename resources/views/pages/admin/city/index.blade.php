@extends('layouts/contentLayoutMaster')
@section('title', 'City')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        .overlay-model {
            background-color: rgb(129 119 119 / 55%);
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
                                <h4 class="card-title">City List</h4>
                            </div>
                            <div class="header-title">
                                <a href="#" class="btn btn-primary rounded-pill mt-2" role="button"
                                    data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i
                                        class="fa-solid fa-plus"></i> Add</a>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <div class="table-responsive">
                                <table id="dataTableList" class="table table-striped" role="grid">
                                    <thead>
                                        <tr class="ligth">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Create Model... --}}
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="background-image: url({{ asset('images/modal_images/city1.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                                <div class="overlay-model">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('city.store') }}" id="validation">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="form-label" for="fname" style="color:white">Name:</label>
                                                <input type="text" class="form-control input-color" name="name" id="name"
                                                    placeholder="Name" style="background: transparent;color: #fff;">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-label" style="color:white">Country:</label>
                                                <select name="country_id" class="selectpicker form-control"
                                                    data-style="py-0" id="country-dropdown" style="background: transparent;color: #fff">
                                                    <option selected disabled style="color: #a7a5a5">Select Country</option>
                                                    @foreach ($country as $countries)
                                                        <option value="{{ $countries->id }}" style="color: #686464">{{ $countries->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-label" style="color:white">State:</label>
                                                <select name="state_id" class="selectpicker form-control" data-style="py-0"
                                                    id="state-dropdown"  style="background: transparent;color: #fff">
                                                    <option selected disabled style="color: #a7a5a5">Select State</option>
                                                    @foreach ($state as $states)
                                                        <option value="{{ $states->id }}" style="color: #686464">{{ $states->name }}</option>
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
                    {{-- Edit Model... --}}
                    @foreach ($city as $cities)
                        <div class="modal fade" id="EditModalCenter{{ $cities->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="background-image: url({{ asset('images/modal_images/city1.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                                    <div class="overlay-model">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('city.update', $cities->id) }}"
                                            id="edit_city{{ $cities->id }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="fname" style="color:white">Name:</label>
                                                    <input type="text" class="form-control input-color"
                                                        name="name" value="{{ $cities->name }}"
                                                        id="name{{ $cities->id }}" placeholder="Name" style="background: transparent;color: #fff;">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" style="color:white">Country:</label>
                                                    <select name="country_id" class="selectpicker form-control"
                                                        data-style="py-0" id="edit-country-dropdown" style="background: transparent;color: #fff">
                                                        <option style="color: #a7a5a5" disabled>Select Country</option>
                                                        @foreach ($country as $countries)
                                                            <option value="{{ $countries->id }}"
                                                                {{ $countries->id == $cities->country_id ? 'Selected' : '' }} style="color: #686464">
                                                                {{ $countries->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" style="color:white">State:</label>
                                                    <select name="state_id" class="selectpicker form-control"
                                                        data-style="py-0" id="edit-state-dropdown" style="background: transparent;color: #fff">
                                                        <option style="color: #a7a5a5" disabled>Select State</option>
                                                        @foreach ($state as $states)
                                                            <option value="{{ $states->id }}"
                                                                {{ $states->id == $cities->state_id ? 'Selected' : '' }} style="color: #686464">
                                                                {{ $states->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer" style=" justify-content: center !important; border-top:0 !important">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal" style="background-color: white; color:#FF6A00;">Close</button>
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
        <a href="javascript:void(0)" id="check" style="display: none;">click here</a>
        <a href="{{ route('admin.order.index') }}" id="index_page" style="display: none;">click here</a>
        <audio id="audio" src="{{ asset('audio/notification.mp3') }}" preload="auto">click me</audio>
    </div>
@endsection

@section('page-script')
    <script>
        $("#validation").validate({
            rules: {
                name: {
                    required: true,
                },
                state_id: {
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
                state_id: {
                    required: "This state field is required",
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
    <script>
        $('#country-dropdown').on('change', function() {
            var idCountry = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{ route('fetchState') }}",
                type: "GET",
                data: {
                    country_id: idCountry,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-dropdown').html('<option value="">Select State</option>');
                    $.each(result.states, function(key, value) {
                        $("#state-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    </script>
    <script>
        $('#edit-country-dropdown').on('change', function() {
            var idCountry = this.value;
            $("#edit-state-dropdown").html('');
            $.ajax({
                url: "{{ route('fetchState') }}",
                type: "GET",
                data: {
                    country_id: idCountry,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#edit-state-dropdown').html('<option value="">Select State</option>');
                    $.each(result.states, function(key, value) {
                        $("#edit-state-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    </script>
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
                ButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('del' + id).click();
                } else
                    return false;
            });
        }
    </script>

    @foreach ($city as $cities)
        <script>
            $('#edit_city{{ $cities->id }}').validate({
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

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        citylistindex = "{{ route('city.index') }}";
    </script>
    {{-- <script>
        checkneworder = "{{ route('admin.order.checkneworder') }}";
    </script>
    <script>
        readneworder = "{{ route('admin.order.readneworder') }}";
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="{{ asset('js/scripts/admin/neworder.js') }}"></script> --}}
    <script src="{{ asset('js/scripts/admin/city.js') }}"></script>
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


    {{-- attention:  --}}
    @foreach ($city as $cities)
        <script>
            $(document).ready(function() {
                $('#name{{ $cities->id }}').keypress(function(event) {
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

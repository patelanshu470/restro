@extends('layouts/contentLayoutMaster')
@section('title', 'Restaurant Edit')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/css/intlTelInput.css" rel="stylesheet" />
    <style>
        #restro_image-error {
            margin-bottom: 4px;
            position: relative;
            top: 20px;
            right: 130px;
            background: transparent;
            /* left: 0; */
            font-size: 0.8rem;
            width: 370px;
        }

        #cover_image-error {
            margin-bottom: 4px;
            position: relative;
            background: transparent;
            top: 20px;
            right: 120px;
            /* left: 0; */
            width: 300px;
            font-size: 0.8rem;
        }

        #logo_image-error {
            margin-bottom: 4px;
            position: relative;
            background: transparent;
            top: 20px;
            right: 120px;
            /* left: 0; */
            width: 300px;
            font-size: 0.8rem;
        }

        .img-thumbs {
            background: #eee;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            margin: 1.5rem 0;
            padding: 0.75rem;
        }

        .img-thumbs-hidden {
            display: none;
        }

        .wrapper-thumb {
            position: relative;
            display: inline-block;
            margin: 1rem 0;
            justify-content: space-around;
        }

        .img-preview-thumb {
            background: #fff;
            border: 1px solid none;
            border-radius: 0.25rem;
            box-shadow: 0.125rem 0.125rem 0.0625rem rgba(0, 0, 0, 0.12);
            margin-right: 1rem;
            max-width: 140px;
            padding: 0.25rem;
        }

        .remove-btn {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: .7rem;
            top: -5px;
            right: 10px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .remove-btn:hover {
            box-shadow: 0px 0px 3px grey;
            transition: all .3s ease-in-out;
        }

        #product_thumnail-error {
            margin-bottom: 6px;
            position: relative;
            top: 20px;
            right: 100px;
            width: 300px;
            font-size: 1rem;
            background: transparent;
        }

        #image_preview {
            background: #eee;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            margin: 1.5rem 0;
            padding: 0.75rem;
        }

        .img-div {
            position: relative;
            display: inline-block;
            margin: 1rem 0;
        }

        .img-thumbnail {
            background: #fff;
            border: 1px solid none;
            border-radius: 0.25rem;
            box-shadow: 0.125rem 0.125rem 0.0625rem rgb(0 0 0 / 12%);
            margin-right: 1rem;
            max-width: 140px;
            padding: 0.25rem;
        }

        .middle {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: .7rem;
            top: -5px;
            right: 10px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .selected-flag {
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }

        @media only screen and (min-width: 768px) {
            #phone_number {
                width: 600px;
            }

            #phone1 {
                width: 400px;
            }
        }

        @media only screen and (min-width: 1920px) {
            #phone_number {
                width: 840px;
            }

            #phone1 {
                width: 550px;
            }
        }

        @media only screen and (max-width: 1024px) {
            #phone_number {
                width: 440px;
            }

            #phone1 {
                width: 280px;
            }
        }
        .iti {
            width: 100%;
        }
        .iti--separate-dial-code .iti__selected-flag {
            border-bottom-left-radius: 15px;
            border-top-left-radius: 15px;
        }
    </style>
@endsection

@section('content')
    @include('panels/loading')
    <div class="content-inner mt-5 py-0">
        <div>
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Edit Restaurant</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">
                                <form method="POST" enctype="multipart/form-data"
                                    action="{{ route('restaurant.update', $restaurant->id) }}" id="edit_validation"
                                    onsubmit="return validateForm()">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">


                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="fname">Restaurant Name:</label>
                                            <input type="text" class="form-control"
                                                value="{{ $restaurant->restaurant_name }}" name="restaurant_name"
                                                id="fname" placeholder="Restaurant Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="lname">Contact Number:</label>
                                            <div class="">
                                                <input type="text" id="restro_contact_number" name="restro_contact_number" value="{{ $restaurant->restro_contact_number }}" class="form-control" style="width: 100%">
                                            </div>
                                            <label id="restro_contact_number-error" class="error" style="display: none"></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="add1">Street</label>
                                            <input type="text" class="form-control" name="street"
                                                value="{{ $fetch_address->street }}" id="add1" placeholder="Street">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="add2">Landmark</label>
                                            <input type="text" class="form-control" name="landmark"
                                                value="{{ $fetch_address->landmark }}" id="add2"
                                                placeholder="Landmark">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Country:</label>
                                            <select name="country" id="country" class="form-control" data-style="py-0"
                                                required>
                                                <option disabled selected>Select Country</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">State:</label>
                                            <select name="state" id="state" class="selectpicker form-control"
                                                data-style="py-0" required>
                                                <option disabled selected>Select State</option>>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">City:</label>
                                            <select name="city" id="city" class="selectpicker form-control"
                                                data-style="py-0" required>
                                                <option selected disabled>Select City</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="pno">Pin Code:</label>
                                            <input type="text" class="form-control"
                                                value="{{ $fetch_address->pincode }}" name="pincode" id="pno"
                                                placeholder="Pin Code">
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 class="mb-3">Manager Information</h5>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="fname">First Name:</label>
                                            <input type="text" class="form-control"
                                                value="{{ $fetch_manager->first_name }}" name="first_name"
                                                id="fname" placeholder="First Name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="lname">Last Name:</label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="{{ $fetch_manager->last_name }}" id="lname"
                                                placeholder="Last Name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Contact Number: </label>
                                            <div class="input-group">
                                                <input type="text" id="manager_number"class="form-control" name="manager_number" value="{{ $fetch_manager->phone_number  }}" style="width: 100%">
                                            </div>
                                            <label id="manager_number-error" class="error" for="manager_number" style="display: none"></label>
                                            <p style="color:#ea5455;display: none;" class="check"
                                                id="phone_number_error">This Number Already Used</p>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/scripts/admin/restaurant.js') }}"></script>

    <script>
        $("button[type='submit']").mouseover(function() {
            var checklogo = $("#error2").css("display");
            // alert(checklogo);
            if (checklogo == 'block') {
                $('button:submit').attr('disabled', true);
            }
        });
    </script>
    <script src="{{ asset('js/country/countries_states_cities.json') }}"></script>
    <script>
        var user_country_code = "{{ $fetch_address->country }}";
        var user_state_code = "{{ $fetch_address->state }}"; // Replace with the desired state code
        var user_city_name = "{{ $fetch_address->city }}"; // Replace with the desired city name

        function initializeDropdowns(data) {
            const country_array = data.map(country => {
                return {
                    code: country.iso2,
                    name: country.name
                };
            });
            const states_array = data.map(country => {
                return {
                    country_code: country.iso2,
                    states: country.states.map(state => {
                        return {
                            code: state.state_code,
                            name: state.name,
                            cities: state.cities
                        };
                    })
                };
            });
            const id_state_option = document.getElementById("state");
            const id_country_option = document.getElementById("country");
            const id_city_option = document.getElementById("city");

            const createCountryNamesDropdown = () => {
                let option = '<option selected disabled>select country</option>';
                for (let country of country_array) {
                    let selected = (country.code == user_country_code) ? ' selected' : '';
                    option += '<option value="' + country.code + '"' + selected + '>' + country.name + '</option>';
                }
                id_country_option.innerHTML = option;
            };

            const createStatesNamesDropdown = () => {
                let selected_country_code = id_country_option.value;
                let state_obj = states_array.find(obj => obj.country_code === selected_country_code);
                if (!state_obj) {
                    id_state_option.innerHTML = '<option selected disabled>select state</option>';
                    id_city_option.innerHTML =
                    '<option selected disabled>select city</option>'; // Reset the city dropdown
                    return;
                }
                let state_names = state_obj.states;
                let option = '<option selected disabled>select state</option>';
                for (let state of state_names) {
                    option += '<option value="' + state.code + '">' + state.name + '</option>';
                }
                id_state_option.innerHTML = option;

                // Set the desired state directly
                id_state_option.value = user_state_code;
                createCitiesDropdown();
            };

            const createCitiesDropdown = () => {
                let selected_state_code = id_state_option.value;
                let selected_country_code = id_country_option.value;
                let state_obj = states_array.find(obj => obj.country_code === selected_country_code);
                if (!state_obj) {
                    id_city_option.innerHTML = '<option selected disabled>select city</option>';
                    return;
                }
                let state = state_obj.states.find(state => state.code === selected_state_code);
                if (!state || !state.cities) {
                    id_city_option.innerHTML = '<option selected disabled>select city</option>';
                    return;
                }
                let city_names = state.cities;
                let option = '<option selected disabled>select city</option>';
                for (let city of city_names) {
                    option += '<option value="' + city.name + '">' + city.name + '</option>';
                }
                id_city_option.innerHTML = option;

                // Set the desired city directly
                id_city_option.value = user_city_name;
            };

            id_country_option.addEventListener('change', createStatesNamesDropdown);
            id_state_option.addEventListener('change', createCitiesDropdown);

            createCountryNamesDropdown();
            createStatesNamesDropdown();
            createCitiesDropdown();
        }

        // Load and parse the JSON file
        fetch('{{ asset('js/country/countries_states_cities.json') }}')
            .then(response => response.json())
            .then(data => {
                initializeDropdowns(data);
            })
            .catch(error => {
                console.error('Error fetching JSON file:', error);
            });
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script>
        var phone_number = window.intlTelInput(document.querySelector("#manager_number"), {
            separateDialCode: true,
            preferredCountries: ["US"],
            hiddenInput: "manager_number",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });
    </script>
    <script>
        var contact_number = window.intlTelInput(document.querySelector("#restro_contact_number"), {
            separateDialCode: true,
            preferredCountries: ["US"],
            hiddenInput: "restro_contact_number",
            hiddenInputValue: "6763453434",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });
    </script>
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

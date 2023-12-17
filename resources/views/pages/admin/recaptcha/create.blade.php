@extends('layouts/contentLayoutMaster')
@section('title', 'ReCaptcha')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        #restro_image-error{
        margin-bottom: 4px;
        position: relative;
        top: 20px;
        right: 130px;
        background: transparent;
        /* left: 0; */
        font-size: 0.8rem;
        width: 370px;
        }
        #cover_image-error{
        margin-bottom: 4px;
        position: relative;
        background: transparent;
        top: 20px;
        right: 120px;
        /* left: 0; */
        width: 300px;
        font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')
    <div class="content-inner mt-5 py-0">
        <div>
             <div class="row">
                <div class="col-xl-12 col-lg-12">
                   <div class="card">
                      <div class="card-header d-flex justify-content-between">
                         <div class="header-title">
                            <h4 class="card-title">Google reCaptcha</h4>
                         </div>
                      </div>
                      <div class="card-body">
                         <div class="new-user-info">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('recaptcha.store') }}" id="add_recaptcha">
                                @csrf
                                @php
                                     $recaptcha = App\Models\Recaptcha::first();
                                @endphp
                                <div class="row">
                                    <div class="form-group col-md-6 form-switch">
                                        <label class="form-label" for="status">Status:</label>
                                        <input data-id="{{$recaptcha->id}}" class="form-check-input status" type="checkbox" data-on="1" data-off="0" name="status" id="flexSwitchCheckDefault" {{ $recaptcha->status ? 'checked' : '' }} style="width: 40px; height:20px; margin-left:5px">
                                    </div>
                                </div>
                               <div class="row">
                                @if (!$recaptcha == null)
                                  <div class="form-group col-md-6">
                                     <label class="form-label" for="site_key">Site Key:</label>
                                     <input type="text" class="form-control" value="{{ $recaptchas->site_key }}" name="site_key" id="site_key" placeholder="Site Key" required>
                                  </div>
                                  <div class="form-group col-md-6">
                                     <label class="form-label" for="">Secret Key:</label>
                                     <input type="text" class="form-control" name="secret_key" value="{{  $recaptchas->secret_key  }}" id="secret_key" placeholder="Secret Key" required>
                                  </div>
                                  @endif
                                  @if ($recaptcha == null)

                                  <div class="form-group col-md-6">
                                    <label class="form-label" for="site_key">Site Key:</label>
                                    <input type="text" class="form-control" value="" name="site_key" id="site_key" placeholder="Site Key" required>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label class="form-label" for="">Secret Key:</label>
                                    <input type="text" class="form-control" name="secret_key" value="" id="secret_key" placeholder="Secret Key" required>
                                 </div>
                                  @endif
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
<script>
$(function() {
$('.status').change(function() {
    var status = $(this).prop('checked') == true ? 1 : 0;
    var recaptcha_id = $(this).data('id');

    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "positionClass": "toast-top-right"
    };

    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{route('recaptchastatus')}}",
        data: {'status': status, 'recaptcha_id': recaptcha_id},
        success: function(data){
            if (data.success) {
                toastr.success(data.success);
            }
            if (data.error) {
                toastr.error(data.error);
            }
        }
    });
})
})
</script>
{{-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> --}}
    <script src="{{asset('js/scripts/admin/recaptcha.js')}}"></script>
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

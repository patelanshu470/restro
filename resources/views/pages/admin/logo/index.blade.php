@extends('layouts/contentLayoutMaster')
@section('title', 'Logo')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        #logo-error{
        margin-bottom: 4px;
        position: relative;
        top: 20px;
        right: 170px;
        background: transparent;
        /* left: 0; */
        font-size: 0.8rem;
        width: 370px;
        }
        #favicon-error{
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
                            <h4 class="card-title">Logo</h4>
                         </div>
                      </div>
                      <div class="card-body">
                         <div class="new-user-info">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('logo.store') }}" id="add_logo">
                                @csrf
                                @php
                                     $logos = App\Models\Logo::first();
                                    //  dd($logos);
                                @endphp
                                <div class="row">
                                    @if (!$logos == null)
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="logo">Logo:</label>
                                        <div class="profile-img-edit position-relative">
                                           <img class="profile-pic rounded avatar-100" src="{{ asset('images/logo/'.$logos->logo) }}" alt="profile-pic">
                                           <div class="upload-icone bg-primary">
                                            <i class="fa-solid fa-pen" style="color:white;"></i>
                                              <input class="file-upload-test form-control " style="position:relative; bottom:30px; right:5px;opacity:0" accept="image/jpg,image/png,image/jpeg" name="logo" id="logo" type="file" >
                                           </div>
                                        </div>
                                        <div class="img-extension mt-3">
                                           <div class="d-inline-block align-items-center">
                                              <span>Logo</span><br>
                                              <span ><a href="javascript:void();">.jpg .png .jpeg</a></span><br>
                                              <span id="error" style="color: red"></span>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <label class="form-label" for="retro_image">Favicon Icon:</label>
                                        <div class="profile-img-edit position-relative">
                                           <img class="profile-cover rounded avatar-100" src="{{ asset('images/logo/'.$logos->favicon_icon) }}" alt="profile-pic">
                                           <div class="upload-icone bg-primary">
                                            <i class="fa-solid fa-pen" style="color:white;"></i>
                                              <input class="file-upload-cover form-control " style="position:relative; bottom:30px; right:5px;opacity:0" accept="image/jpg,image/png,image/jpeg" name="favicon" id="favicon" type="file" >
                                           </div>
                                        </div>
                                        <div class="img-extension mt-3">
                                           <div class="d-inline-block align-items-center">
                                              <span>Favicon Icon</span><br>
                                              <span ><a href="javascript:void();">.jpg .png .jpeg</a></span><br>
                                              <span id="error" style="color: red"></span>
                                           </div>
                                        </div>
                                     </div>
                                    @endif
                                    @if ($logos == null)
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="logo">Logo:</label>
                                        <div class="profile-img-edit position-relative">
                                           <img class="profile-pic rounded avatar-100" src="{{ asset('no-image.jpg') }}" alt="profile-pic">
                                           <div class="upload-icone bg-primary">
                                            <i class="fa-solid fa-pen" style="color:white;"></i>
                                              <input class="file-upload-test form-control " style="position:relative; bottom:30px; right:5px;opacity:0" accept="image/jpg,image/png,image/jpeg" name="logo" id="logo" type="file" >
                                           </div>
                                        </div>
                                        <div class="img-extension mt-3">
                                           <div class="d-inline-block align-items-center">
                                              <span>Logo</span><br>
                                              <span ><a href="javascript:void();">.jpg .png .jpeg</a></span><br>
                                              <span id="error" style="color: red"></span>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <label class="form-label" for="retro_image">Favicon Icon:</label>
                                        <div class="profile-img-edit position-relative">
                                           <img class="profile-cover rounded avatar-100" src="{{ asset('no-image.jpg') }}" alt="profile-pic">
                                           <div class="upload-icone bg-primary">
                                            <i class="fa-solid fa-pen" style="color:white;"></i>
                                              <input class="file-upload-cover form-control " style="position:relative; bottom:30px; right:5px;opacity:0" accept="image/jpg,image/png,image/jpeg" name="favicon" id="favicon" type="file" >
                                           </div>
                                        </div>
                                        <div class="img-extension mt-3">
                                           <div class="d-inline-block align-items-center">
                                              <span>Favicon Icon</span><br>
                                              <span ><a href="javascript:void();">.jpg .png .jpeg</a></span><br>
                                              <span id="error" style="color: red"></span>
                                           </div>
                                        </div>
                                     </div>
                                    @endif
                                </div>
                               </div>
                               <hr>
                               <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <a href="javascript:void(0)" id="check" style="display: none;">click here</a>
          <a href="{{ route('admin.order.index') }}" id="index_page" style="display: none;">click here</a>
          <audio id="audio" src="{{ asset('audio/notification.mp3') }}" preload="auto">click me</audio>
    </div>
@endsection

@section('page-script')
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        checkneworder = "{{ route('admin.order.checkneworder') }}";
    </script>
    <script>
        readneworder = "{{ route('admin.order.readneworder') }}";
    </script> --}}
    {{-- <script src="{{asset('js/scripts/admin/neworder.js')}}"></script> --}}
    <script src="{{asset('js/scripts/admin/logo.js')}}"></script>
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

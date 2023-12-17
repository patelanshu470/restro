@extends('layouts/fullLayoutMaster')
@section('title', 'OTP')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
@endsection

@section('content')
<style>
            *{
  box-sizing: border-box;
}
body{
  margin: 0;
}
.title{
  max-width: 400px;
  margin: auto;
  text-align: center;
  font-family: "Poppins", sans-serif;
  h3{
    font-weight: bold;
  }
  p{
    font-size: 12px;
    color: #f7dcc8;
    &.msg{
    }
      color: initial;
      text-align: initial;
      font-weight: bold;
    }
}

.otp-input-fields{
  margin: auto;
  /* background-color: white; */
  /* box-shadow: 0px 0px 8px 0px #02025044; */
  max-width: 400px;
  width: auto;
  display: flex;
  justify-content: center;
  gap: 10px;
  padding: 40px;
  background: transparent;
  padding-top: 20px;
  padding-bottom: 0;
}
    input{
    height: 40px;
    width: 40px;
    background-color: transparent;
    border-radius: 4px;
    border: 1px solid #f7dcc8;
    text-align: center;
    outline: none;
    font-size: 16px;
    &::-webkit-outer-spin-button,
    &::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    &[type=number] {
      -moz-appearance: textfield;
    }
    &:focus{
      border-width: 2px;
      border-color: darken(#f7dcc8, 10%);
      font-size: 20px;
    }

}
input:focus{
    border: 2px solid #f7b787;
}
input[type=number]::-webkit-inner-spin-button {
  -webkit-appearance: none;
}
.result{
  max-width: 400px;
  margin: auto;
  padding: 24px;
  text-align: center;
  p{
    font-size: 24px;
    font-family: 'Antonio', sans-serif;
    opacity: 1;
    transition: color 0.5s ease;
    &._ok{
      color: #f7dcc8;
    }
    &._notok{
      color: red;
      border-radius: 3px;
    }
  }
}
</style>
    @include('panels/loading')
    @include('notification')
    <div class="wrapper">
        <section class="container-fluid bg-circle-login" id="auth-sign">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-7 col-xl-4">
                    <div class="card-body">
                        <a href="#">
                            <img src="{{ asset('images/favicon.png') }}" class="img-fluid logo-img" alt="img4">
                        </a>
                        @php
                            $aa =  App\Models\VerificationCode::latest()->first();
                            $timee = $aa->expire_at;
                            $create = $aa->created_at;
                            $forma = date('M d Y H:i:s', strtotime($timee));
                            $create_at = date('M d Y H:i:s', strtotime($create));
                            $mobile = App\Models\User::where([['id','=',$user_id]])->first();
                            $para_no=$mobile->email;
                        @endphp
                        <h2 class="mb-2 text-center">Account Verification</h2>
                        <form method="POST" action="{{ route('otp.changeemail') }}" class="otp-form" name="otp-form" id="validation">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-0">
                                        <input type="hidden" name="user_id" value="{{$user_id}}" />
                                      <h3><label for="phone_number" class="form-label d-flex justify-content-center">OTP</label></h3>
                                      <p id="demo" class="d-flex justify-content-center"></p>
                                            <div class="otp-input-fields justify-content-center">
                                                <input type="number" name="otps" class="otp__digit otp__field__1" id="otp" >
                                                <input type="number" name="otps" class="otp__digit otp__field__2" id="otp">
                                                <input type="number" name="otps" class="otp__digit otp__field__3" id="otp">
                                                <input type="number" name="otps" class="otp__digit otp__field__4" id="otp">
                                                <input type="number" name="otps" class="otp__digit otp__field__5" id="otp">
                                                <input type="number" name="otps" class="otp__digit otp__field__6" id="otp">
                                                @error('otp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                              </div>
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="result">
                                            <textarea name="otp" hidden id="_otp" class="_notok  @error('otp') is-invalid @enderror" cols="10" rows="02"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 d-flex justify-content-between">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <div class="d-flex justify-content-center">
                            </div>
                            <p class="mt-3 text-center">
                                Resend OTP?<a class=""  href="{{route('otp.resendemail',$para_no)}}" style="pointer-events: none; margin-left:5px"  id="resend" >Click Here New OTP</a>
                            </p>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-xl-8 d-lg-block d-none vh-100 overflow-hidden">
                    <img src="{{ asset('images/auth/09.png') }}" class="img-fluid sign-in-img" alt="images">

                </div>
            </div>
        </section>
    </div>
    <script>
    var countDownDate = new Date('{{ $forma }}').getTime();
    // Update the count down every 1 second
    var x = setInterval(function() {
    // Get today's date and time
    var now = new Date();
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML =   minutes + "m " + seconds + "s ";
    if (distance < 0) {
        element = document.getElementById('resend');
        element.style = "";

        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
    }, 1000);
    </script>
    <script>
    $('#validation').validate({
    rules: {
        otps: {
            required: true
     }

    },
    messages: {
        otps: {
        required: "This otp field is required",
      }

    }
})
    </script>
@endsection

@section('page-script')
<script src="{{ asset('js/scripts/auth/otp-verification.js') }}"></script>
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

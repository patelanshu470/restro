@extends('layouts/contentLayoutMaster')
@section('title', 'Profile')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        .category-button:hover {
            background-color: #FAC281;
            transition: 0.7s;
            color: #fff;
        }

        .active {
            color: #fff;
        }

        #logo-error {
            margin-bottom: 4px;
            position: relative;
            top: 20px;
            right: 170px;
            background: transparent;
            font-size: 0.8rem;
            width: 370px;
        }

        #favicon-error {
            margin-bottom: 4px;
            position: relative;
            background: transparent;
            top: 20px;
            right: 120px;
            width: 300px;
            font-size: 0.8rem;
        }

        .nav-tabs .nav-link.active {
            border-bottom: none;
        }
        #default_address_id{
            margin-top: 5px;
            margin-left: 10px;
            height: 20px;
            width: 20px;
            position: absolute;
            background-color: #fff4e7;
            border-radius: 50%;
        }
        .confirm-text{
            width: 70%;
            margin: 0 auto;
            justify-content: center;
        }
        .order_confirm_dflex{
            width: 70%;
            margin: 0 auto;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')
    <div class="content-inner mt-5 py-0">
        <div>
            <div class="row gx-5">
                <div class="confirm-head text-center mt-4">
                  <h1 class="mb-3 text-primary">{{__('Thank You!')}}</h1>
                  <h4>{!!__("Yor Order #:order has been placed!",['order'=>$order->id])!!}</h4>
                  <p class="confirm-text mt-2">
                    {!!__("We sent an email to <b>:email</b> with your order confirmation and receipt. if the email hasn't arrived within two minute, please check your spam folder to see if the email was routed there.",['email' => Auth::user()->email])!!}
                  </p>
                  <div class="d-flex order_confirm_dflex mt-2">
                    <i class="fa-regular fa-clock text-primary" style="font-size: 20px; margin-top:4px"></i>
                    <p>
                      <b class="ps-1">{{__('Time Placed')}} :-</b> <span>{{date('d-m-Y h:i:s',strtotime($order->created_at))}}</span>
                    </p>
                  </div>
                </div>

                <div class="confirm-detail">
                  <div class="confirm-address m-3">
                    <div class="row">
                      <div class="col-sm-4 card p-4 mt-3" style="margin-right: 10px">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <h5 class="mt-2">{{__('Shipping Details')}}</h5>
                        <p class="m-0">{{$order->shipping_contact_name}}</p>
                        {{-- <p class="m-0">{{$shipping_address->street}}</p>
                        <p class="m-0">{{$shipping_address->landmark}}</p>
                        <p class="m-0">{{$shipping_address->cities->name}}, {{$shipping_address->states->name}}, {{$shipping_address->pincode}}</p>
                        <p class="m-0">{{$shipping_address->countries->name}}</p> --}}
                        <p class="m-0">{{$order->shipping_contact_number}}</p>
                      </div>
                      <div class="col-sm-4 card p-4 mt-3" style="margin-right: 10px">
                        <i class="fa-regular fa-file-lines"></i>
                        <h5 class="mt-2">{{__('Billing Details')}}</h5>
                        <p class="m-0">{{$order->billing_contact_name}}</p>
                        {{-- <p class="m-0">{{$billing_address->street}}</p>
                        <p class="m-0">{{$billing_address->landmark}}</p>
                        <p class="m-0">{{$billing_address->cities->name}}, {{$billing_address->states->name}}, {{$billing_address->pincode}}</p>
                        <p class="m-0">{{$shipping_address->countries->name }}</p> --}}
                        <p class="m-0">{{$order->billing_contact_number}}</p>
                      </div>
                      <div class="col-sm-3 card p-4 mt-3" style="width: 32%;">
                        <i class="fa-solid fa-truck"></i>
                        <h5 class="mt-2">{{__('Payment Method')}}</h5>
                        <p>{{$order->payment_method}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="confirm-list mt-5">
                    <div class="row">
                      <div class="col-md-8 mt-3">
                        <h4>{{__('Product List')}}</h4>
                        <hr />
                        @foreach ($OrderProduct as $product)

                        <div class="card p-3 mt-3">
                            <div class="row">
                              <div class="col-3">
                                @if (isset($product->getproductsData->image[0]) &&
                                !empty($product->getproductsData->image[0]))
                                <img
                                    src="{{asset('images/product/thumbnail/'.$product->getproductsData->image[0]['path'])}}" width="130px">
                                @else
                                <img src="https://dummyimage.com/600x400/55595c/fff"
                                    alt="Product">
                                @endif
                              </div>
                              <div class="col-6">
                                <p class="m-0">
                                 <a href='#'><b>{{$product->getproductsData->name}}</b></a>
                                </p>
                              </div>
                              <div class="col-3 text-end">
                                <div class="d-flex order_confirm_dflex">
                                  <div>
                                    <p class="mb-1"><b>{{__('Price')}} :</b></p>
                                     <p class="mb-1"><b>{{__('Qty')}} :</b></p>
                                    <p class="mb-1"><b>{{__('Discount')}} :</b></p>
                                    <p class="mb-1"><b>{{__('Total')}} :</b></p>
                                  </div>
                                  <div class="confirm-list ms-4">
                                    <p class="mb-1"><b>{{number_format($product->price,2)}}</b></p>
                                    <p class="mb-1 text-center"><b>{{$product->quantity}}</b></p>
                                    <p class="mb-1"><b>{{number_format($product->discount,2)}}</b></p>
                                    <p class="mb-1"><b>{{number_format($product->total_price,2)}}</b></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>

                      <div class="col-md-4" style="padding-top: 48px">
                        <hr>
                        <div class="card confirm-summary p-4">
                          <h4 class="mb-0">{{__('Order Summary')}}</h4>
                          {{-- <hr /> --}}
                          <div class="d-flex order_confirm_dflex" style="padding-top: 10px">
                            <div>
                              <p class="mb-0">{{__('Subtotal')}}:</p>
                              <p class="mb-0">{{__('Discount')}}:</p>
                            </div>
                            <div class="ms-auto">
                              <p class="mb-0">{{number_format($order->subtotal,2)}}</p>
                              <p class="mb-0">{{number_format($order->total_discount,2)}}</p>
                            </div>
                          </div>
                          <hr />
                          <div class="d-flex order_confirm_dflex">
                            <div>
                              <p class="mb-0"><b>{{__('Total')}}</b></p>
                            </div>
                            <div class="ms-auto">
                              <p class="mb-0"><b>{{number_format($order->grand_total,2)}}</b></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="others-options lg-none justify-content-center d-flex order_confirm_dflex mt-3 mb-6">
                    <a href="{{ route('home') }}" class="btn btn-primary style2">{{__('CONTINUE SHOPPING')}}</a>
                  </div>
                </div>
              </div>
        </div>
    </div>


    {{-- <script>
        $(window).on('popstate', function(event) {
            window.location.href = "{{ route('user.view_cart') }}";
    });
    </script> --}}
@endsection

@section('page-script')
    <script src="{{ asset('js/scripts/admin/logo.js') }}"></script>
    <script src="{{ asset('js/scripts/admin/recaptcha.js') }}"></script>
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

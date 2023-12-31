@extends('layouts/contentLayoutMaster')
@section('title', 'Product')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        #swal2-validation-message{
            width: 100%;
            margin-left: 4px;
        }
    </style>
@endsection

@section('content')
@include('panels/loading')
<div class="content-inner mt-5 py-0">
    <div class="d-flex flex-wrap justify-content-between">
    <div class="d-flex align-items-center flex-wrap mb-4 mb-lg-0">
        <a href="{{ route('restro.order.invoice',$order->id) }}">
            <button type="button" class="btn btn-outline-primary me-5 rounded-pill">#INV-0012456</button>
        </a>
        <div class="d-flex align-items-end ms-5">
            <span class="text-dark fw-bolder">Orders /</span>
            @if ($order->type == 'take_away')
                <span class="mb-0 fw-bolder">Take Away</span>
            @else
                <span class="mb-0 fw-bolder">Dining In</span>
            @endif
        </div>
    </div>
    <div class="d-flex flex-wrap">
        <button type="button" class="btn btn-outline-danger rounded-pill" data-original-title="Delete" onclick="deleteRecord({{ $order->id }})">Cancel Order</button>
        <a href="{{ route('restro.order.canceled',$order->id) }}" id="can{{ $order->id }}" style="display: none"></a>
        <a href="{{ route('restro.order.confirmed',$order->id) }}">
            <button type="button" class="btn text-white btn-success ms-3 rounded-pill">Confirmed Order</button>
        </a>
    </div>
</div>
<div class="row mt-4">
   <div class="col-md-12 col-lg-4 col-xl-3">
        <div class="card ">
            <div class="card-body p-0">
                <div class="p-4 border-bottom">
                    <div class="text-center">
                        <img src="{{ asset('images/order-details/1.png') }}" class="img-fluid avatar-rounded avatar-100" alt="profile-image">
                        <h6 class="mt-3 heading-title fw-bolder">{{ $order->billing_contact_name }}</h6>
                        <button type="button" class="btn btn-outline-primary mt-3 rounded-pill">Customer</button>
                    </div>
                    <div class="d-flex mt-4">
                        <svg width="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5317 12.4724C15.5208 16.4604 16.4258 11.8467 18.9656 14.3848C21.4143 16.8328 22.8216 17.3232 19.7192 20.4247C19.3306 20.737 16.8616 24.4943 8.1846 15.8197C-0.493478 7.144 3.26158 4.67244 3.57397 4.28395C6.68387 1.17385 7.16586 2.58938 9.61449 5.03733C12.1544 7.5765 7.54266 8.48441 11.5317 12.4724Z" stroke="#232D42" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="mb-0 ms-3 fw-bolder text-primary">{{ $order->billing_contact_number }}</span>
                    </div>
                    <div class="d-flex mt-3 ">
                        <i class="fa-regular fa-envelope" style="color: black;padding-top: 6px;font-size: 17px;"></i>
                        <span class="mb-0 ms-3 fw-bolder text-primary">{{ $order->billing_contact_email }}</span>
                    </div>
                </div>
                <div class="p-4">
                    <h6 class="heading-title fw-bolder">Note order</h6>
                    <p class="mb-0 mt-4">{{ $order->order_note }}</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-0">
                <h4 class="">Customer Favourite</h4>
            </div>
            <div class="card-body px-2">
                @php
                    $totalOrders = $Favourite_Product->sum('order_count');
                    $percentage0 = ($Favourite_Product[0]->order_count / $totalOrders) * 100;
                    if (count($Favourite_Product) > 1) {
                        $percentage1 = ($Favourite_Product[1]->order_count / $totalOrders) * 100;
                    }

                @endphp
                <div class="row">
                    <div class="col-md-6  mb-4 mb-md-0">
                        <div id="circle-progress-01" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="{{ $Favourite_Product[0]->percentage0 = $percentage0; }}" data-type="percent">
                        </div>
                        <div class="text-center mt-4">
                            <h6 class="heading-title fw-bolder">{{ $Favourite_Product[0]->name }}</h6>
                            <h6 class="heading-title fw-bolder">{{ $Favourite_Product[0]->order_count }} orders</h6>
                        </div>
                    </div>
                    @if (count($Favourite_Product) > 1)
                    <div class="col-md-6">
                        <div id="circle-progress-02" class="circle-progress-02 circle-progress circle-progress-success text-center" data-min-value="0" data-max-value="100" data-value="{{ $Favourite_Product[1]->percentage1 = $percentage1; }}" data-type="percent">
                        </div>
                        <div class="text-center mt-4">
                            <h6 class="heading-title fw-bolder">{{ $Favourite_Product[1]->name }}</h6>
                            <h6 class="heading-title fw-bolder">{{ $Favourite_Product[1]->order_count }} orders</h6>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-8 col-xl-9">
        <div class="card table-responsive">
            <table class="table table-borderless product-table rounded">
                <thead class="bg-primary ">
                    <tr>
                        <th><span class="heading-title rowpad text-white">Items</span></th>
                        <th><span class="heading-title rowpad text-white">Qty</span></th>
                        <th><span class="heading-title rowpad text-white">Price</span></th>
                        <th><span class="heading-title rowpad text-white">Total Price</span></th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($OrderProduct as $product)
                    <tr class="cart_item border-bottom">
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{asset('images/product/thumbnail/'.$product->getproductsData->image[0]['path'])}}" class="img-fluid avatar-rounded avatar-70" alt="profile-image">
                                <div class="d-flex ms-4">
                                    <div>
                                        <h6 class="heading-title text-primary">{{$product->getproductsData->category->name}}</h6>
                                        <p class="mb-0 fw-bolder">{{ $product->getproductsData->name }}<br>
                                        @if ($product->addon_id != 'null')
                                            @php
                                                // dd($product->addon_id);
                                                $addons = json_decode($product->addon_id);
                                                // dd($addons);
                                                if ($addons) {
                                                    $abc = [];
                                                    foreach ($addons as $addon) {
                                                        $abc[] = \App\Models\Addons::where('id', $addon)
                                                            ->get()
                                                            ->first();
                                                    }
                                                }
                                            @endphp
                                            @if ($addons)
                                            @foreach ($abc as $addonss)
                                               <span class="text-primary" style="font-size: 13px;">Addons :- </span> <span class="text-dark" style="font-size: 12px">{{ $addonss->name }} (${{ $addonss->price }}), : </span>
                                            @endforeach
                                            @endif
                                        @endif <p>
                                        <div class="d-flex mb-2 mt-3">
                                            <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#EA6A12"/>
                                            </svg>
                                            <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#EA6A12"/>
                                            </svg>
                                            <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z" fill="#EA6A12"/>
                                            </svg>
                                            <svg width="18" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z" fill="#EA6A12"/>
                                            </svg>
                                            <svg width="18" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z" fill="#EA6A12"/>
                                            </svg>
                                            <small class="ms-1 text-dark">(400 reviews)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <span class= "rowpad">{{ $product->quantity }}x</span>
                        </td>
                        <td class="">
                            <span class= "rowpad">${{ $product->price }}</span>
                        </td>
                        <td class="">
                            <span class= "rowpad">${{ $product->total_price }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" >
            <div class="col-md-12 col-lg-6 col-xl-6" style="padding: 0">
                <div class="checkout-options">
                    <div class="card">
                        <div class="card-body">
                            <div class="price-details">
                                <h5 class="price-title pb-3">Payment Details</h5>
                                @if ($payment->method == 'card')
                                <ul class="list-unstyled">
                                    <li class="price-detail">
                                        <div class="detail-title">Method</div>
                                        <div class="detail-amt"><span class="product_total">Card</span></div>
                                    </li>
                                    <li class="price-detail">
                                        <div class="detail-title">Card Name</div>
                                        <div class="detail-amt discount-amt text-success">
                                            {{ $payment->card->network }}</div>
                                    </li>
                                    <li class="price-detail">
                                        <div class="detail-title">Card Number</div>
                                        <div class="detail-amt"><span>**** **** **** {{ $payment->card->last4 }}</span>
                                        </div>
                                    </li>
                                </ul>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6" style="padding: 0">
                <div class="checkout-options">
                    <div class="card">
                        <div class="card-body">
                            <div class="price-details">
                                <h5 class="price-title pb-3">Price Details</h5>
                                <ul class="list-unstyled">
                                    <li class="price-detail">
                                        <div class="detail-title">Total MRP</div>
                                        <div class="detail-amt">$<span class="product_total">{{ $order->subtotal }}</span></div>
                                    </li>
                                    <li class="price-detail">
                                        <div class="detail-title">Discount</div>
                                        <div class="detail-amt discount-amt text-success">
                                            ${{ $order->total_discount }}</div>
                                    </li>
                                    <li class="price-detail">
                                        <div class="detail-title">Addons</div>
                                        <div class="detail-amt">$<span>{{ $order->addons_total }}</span>
                                        </div>
                                    </li>
                                    <li class="price-detail">
                                        <div class="detail-title">EMI Eligibility</div>
                                        <a href="#" class="detail-amt text-primary">Details</a>
                                    </li>
                                    <li class="price-detail">
                                        <div class="detail-title">Delivery Charges</div>
                                        <div class="detail-amt discount-amt text-success">Free</div>
                                    </li>
                                </ul>
                                <hr>
                                <ul class="list-unstyled">
                                    <li class="price-detail">
                                        <div class="detail-title detail-total">Total</div>
                                        <div class="detail-amt fw-bolder">$<span class="product_total_all">{{ $order->grand_total }}</span></div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <!-- Checkout Place Order Right ends -->
                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-body">
                <div class="checkout-panel">
                    <div class="panel-body">
                        <div class="stepper">
                            <div class="step active">
                                <a class="persistant-disabled" data-bs-toggle="tab" role="tablist" title="Step 1">
                                    <span class="round-tab">
                                        <svg width="24"  viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.8132 8.31901C19.1763 8.10979 19.5847 8 20 8C20.4153 8 20.8237 8.10979 21.1868 8.31901L30.3718 13.6128C30.5622 13.7227 30.7209 13.8834 30.8313 14.0783C30.9418 14.2732 31 14.4952 31 14.7213V25.1657C30.9999 25.618 30.8832 26.0621 30.6621 26.4519C30.441 26.8417 30.1234 27.163 29.7423 27.3826L21.1868 32.3163C20.8237 32.5255 20.4153 32.6353 20 32.6353C19.5847 32.6353 19.1763 32.5255 18.8132 32.3163L10.2577 27.3826C9.87677 27.1631 9.55933 26.842 9.33821 26.4524C9.11709 26.0629 9.00032 25.619 9 25.1669V14.7213C8.99999 14.4952 9.05823 14.2732 9.16869 14.0783C9.27914 13.8834 9.4378 13.7227 9.62822 13.6128L18.8144 8.31901H18.8132Z" fill="white" stroke="#EA6A12" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9 13.9756L20 20.317L9 13.9756ZM20 20.317L31 13.9756L20 20.317ZM20 20.317V32.9999Z" fill="white"/>
                                        <path d="M20 20.317V32.9999M9 13.9756L20 20.317L9 13.9756ZM20 20.317L31 13.9756L20 20.317Z" stroke="#EA6A12" stroke-linejoin="round"/>
                                        <path d="M14.5 17.1471L25.5 10.8057Z" fill="white"/>
                                        <path d="M14.5 17.1471L25.5 10.8057" stroke="#EA6A12" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.6641 20.7334L16.3307 22.854Z" fill="white"/>
                                        <path d="M12.6641 20.7334L16.3307 22.854" stroke="#EA6A12" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <div class="step active">
                                <a class="persistant-disabled" data-bs-toggle="tab" role="tablist" title="Step 2">
                                    <span class="round-tab">
                                        <svg width="24"  viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20 7.5L23.4521 9.895L27.7257 9.8875L29.038 13.755L32.5 16.1375L31.1719 20L32.5 23.8625L29.038 26.245L27.7257 30.1125L23.4521 30.105L20 32.5L16.5479 30.105L12.2743 30.1125L10.962 26.245L7.5 23.8625L8.82814 20L7.5 16.1375L10.962 13.755L12.2743 9.8875L16.5479 9.895L20 7.5Z" fill="white"/>
                                            <path d="M15 19.375L18.3333 22.5L25 16.25" fill="white"/>
                                            <path d="M15 19.375L18.3333 22.5L25 16.25" stroke="#EA6A12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <div class="step">
                                <a class="persistant-disabled" data-bs-toggle="tab" role="tablist" title="Step 3">
                                    <span class="round-tab">
                                        <svg width="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27.6364 28.9375C28.6927 28.9375 29.5455 28.0163 29.5455 26.875C29.5455 25.7337 28.6927 24.8125 27.6364 24.8125C26.58 24.8125 25.7273 25.7337 25.7273 26.875C25.7273 28.0163 26.58 28.9375 27.6364 28.9375ZM29.5455 16.5625H26.3636V20H32.04L29.5455 16.5625ZM12.3636 28.9375C13.42 28.9375 14.2727 28.0163 14.2727 26.875C14.2727 25.7337 13.42 24.8125 12.3636 24.8125C11.3073 24.8125 10.4545 25.7337 10.4545 26.875C10.4545 28.0163 11.3073 28.9375 12.3636 28.9375ZM30.1818 14.5L34 20V26.875H31.4545C31.4545 29.1575 29.7491 31 27.6364 31C25.5236 31 23.8182 29.1575 23.8182 26.875H16.1818C16.1818 29.1575 14.4764 31 12.3636 31C10.2509 31 8.54545 29.1575 8.54545 26.875H6V11.75C6 10.2237 7.13273 9 8.54545 9H26.3636V14.5H30.1818ZM8.54545 11.75V24.125H9.51273C10.2127 23.2863 11.2309 22.75 12.3636 22.75C13.4964 22.75 14.5145 23.2863 15.2145 24.125H23.8182V11.75H8.54545ZM17.4545 13.125L21.9091 17.9375L17.4545 22.75V19.3125H11.0909V16.5625H17.4545V13.125Z" fill="white"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <div class="step">
                                <a class="persistant-disabled" data-bs-toggle="tab" role="tablist" title="Complete">
                                    <span class="round-tab">
                                        <svg width="24"  viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.3735 8.30477C18.7203 8.10489 19.1104 8 19.5071 8C19.9038 8 20.2939 8.10489 20.6407 8.30477L29.4142 13.3623C29.5961 13.4673 29.7476 13.6208 29.8531 13.807C29.9586 13.9932 30.0142 14.2053 30.0142 14.4213V24.3995C30.0141 24.8316 29.9027 25.2559 29.6915 25.6283C29.4803 26.0007 29.1769 26.3077 28.8129 26.5175L20.6407 31.2309C20.2939 31.4308 19.9038 31.5357 19.5071 31.5357C19.1104 31.5357 18.7203 31.4308 18.3735 31.2309L10.2013 26.5175C9.83748 26.3078 9.53427 26.0009 9.32305 25.6288C9.11184 25.2566 9.00031 24.8326 9 24.4007V14.4213C8.99999 14.2053 9.05562 13.9932 9.16113 13.807C9.26663 13.6208 9.41818 13.4673 9.60007 13.3623L18.3735 8.30477Z" fill="white" stroke="#68CF29" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9 13.707L19.5071 19.7654L9 13.707ZM19.5071 19.7654L30.0142 13.707L19.5071 19.7654ZM19.5071 19.7654V31.8822V19.7654Z" fill="white"/>
                                        <path d="M19.5071 19.7654V31.8822M9 13.707L19.5071 19.7654L9 13.707ZM19.5071 19.7654L30.0142 13.707L19.5071 19.7654Z" stroke="#68CF29" stroke-linejoin="round"/>
                                        <path d="M14.2461 16.7381L24.7532 10.6797L14.2461 16.7381Z" fill="white"/>
                                        <path d="M14.2461 16.7381L24.7532 10.6797" stroke="#68CF29" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.5078 20.1641L16.0102 22.19L12.5078 20.1641Z" fill="white"/>
                                        <path d="M12.5078 20.1641L16.0102 22.19" stroke="#68CF29" stroke-linecap="round" stroke-linejoin="round"/>
                                        <rect x="24.6094" y="22.5488" width="8.88875" height="8.95141" rx="4.44438" fill="white"/>
                                        <path d="M26.1133 27.6199L27.8085 29.2311L31.1989 25.2031" stroke="#68CF29" stroke-linecap="round" stroke-linejoin="round"/>
                                        <rect x="24.6094" y="22.5488" width="8.88875" height="8.95141" rx="4.44438" stroke="#68CF29"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap">
                            <div class="div  mb-3 mb--md-0">
                                <h6 class="heading-title fw-bolder mb-2">Order Created</h6>
                                <p class="mb-0">Thu 21 Jul 2020,</p>
                                <p class="mb-0">10:44 AM</p>
                            </div>
                            <div class="div  mb-3 mb-md-0">
                                <h6 class="heading-title fw-bolder mb-2">Payment Success</h6>
                                <p class="mb-0">Fri 22 Jul 2020,</p>
                                <p class="mb-0">10:44 AM</p>
                            </div>
                            <div class="div">
                                <h6 class="heading-title fw-bolder mb-2">On Delivery</h6>
                                <p class="mb-0">Sat 23 Jul 2020,</p>
                                <p class="mb-0">1:24 PM</p>
                            </div>
                            <div class="div">
                                <h6 class="heading-title fw-bolder mb-2">Order Delivered</h6>
                                <p class="mb-0">Sat 23 Jul 2020,</p>
                                <p class="mb-0">1:24 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
</div>
@endsection


@section('page-script')
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    function deleteRecord(id) {
        var form = $('#create_country');
    Swal.fire({
            title: "Are you sure?",
            text: "Canceled this Order",
            input: 'textarea',
            inputValue: '',
            inputPlaceholder: 'Enter Order Canceled Reason',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EA6A12",
            cancelButtonColor: "#959895",
            confirmButtonText: "Yes, Cancelled it!",
            inputValidator: (value) => {
                if (!value) {
                    return 'Please enter Order Cancel Reason'
                }
            }
    }).then((result) => {
        if (result.isConfirmed) {
            var inputVal = result.value;

            toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
            };

            $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('restro.order.canceled',$order->id) }}",
            data: {'canceled_reason': inputVal},
            beforeSend: function(data) {
                jQuery(document).find('#loading').show();
            },
            success: function(data){
                if (data.success) {
                    jQuery(document).find('#loading').hide();
                    toastr.success(data.error);
                    document.getElementById('can' + id).click();
                }
                if (data.error) {
                    jQuery(document).find('#loading').hide();
                    toastr.error(data.error);
                    document.getElementById('can' + id).click();
                }
            }
        });
        } else
            return false;
    });
    }
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
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
@endsection

<nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
    <div class="container-fluid navbar-inner">
        <a href="#" class="navbar-brand">
            <style>
                #notification-drop .count {
                    position: absolute;
                    height: 20px;
                    width: 20px;
                    background-color: #ea6a12;
                    border-radius: 500px;
                    font-size: 14px;
                    display: inline-flex;
                    justify-content: center;
                    align-items: center;
                    top: 3px;
                    right: 3px;
                    color: #fff;
                    transform: translate(50%, -50%);
                    z-index: 1;
                }

                .navbar-light .navbar-nav .show>.nav-link,
                .navbar-light .navbar-nav .nav-link.active {
                    color: #ea6a12;
                }
            </style>
            {{-- <div class="logo-hover">
                <img src="{{ asset('images/favicon.png') }}" class="img-fluid logo-img" alt="img4">
            </div> --}}
        </a>
        {{-- <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20px" height="20px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                </svg>
            </i>
        </div> --}}
        {{-- <div class="input-group search-input">
            <span class="input-group-text" id="search-input">
                <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                    <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </span>
            <input type="search" class="form-control" placeholder="Search...">
        </div> --}}
        <a class="nav-link py-0 d-flex align-items-center" href="{{ route('home') }}" role="button" aria-expanded="false">
            <img style="width: auto" src="{{ asset('images/logo1.png') }}" alt="User-Profile"
                class="img-fluid avatar avatar-50 avatar-rounded">

        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <span class="navbar-toggler-bar bar1 mt-2"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- 3icons  --}}
            {{-- <ul class="navbar-nav ms-2 align-items-center navbar-list mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a href="{{ route('home') }}" class="nav-link" id="notification-drop">
                        <i class="fa-solid fa-house fs-5" viewBox="0 0 18 21"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('user.product_list') }}"
                        class="nav-link {{ Route::currentRouteName() === 'user.product_list' ? 'active' : '' }}"
                        id="notification-drop">
                        <i class="fa-solid fa-bowl-food fs-5" viewBox="0 0 18 21"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="notification-drop">
                        <i class="fa-solid fa-heart fs-5" viewBox="0 0 18 21"></i>
                    </a>
                </li>
            </ul> --}}
            {{-- attention:  --}}
            <form action="{{ route('user.product_list') }}" method="get">
                <div class="input-group search-input" style="">

                    <input type="search" name="search_text" class="form-control" placeholder="Search...">
                    <span class="input-group-text" id="search-input" style="padding-right: 20px;">
                        <button type="submit"
                            style="background: transparent;
                            border: 0px;">
                            <i class="fa-brands fa-searchengin"></i>
                            {{-- <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                            <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> --}}
                        </button>
                    </span>

                </div>
            </form>
            @if(Auth::check())
            <a href="{{ route('user.table_reservation') }}">
                <button type="button" class="btn btn-primary" style="margin-left: 14px;">
                    Table Reservation
                </button>
            </a>
            @else
            <a href="{{ route('login') }}">
                <button type="button" class="btn btn-primary" style="margin-left: 14px;">
                    Table Reservation
                </button>
            </a>
            @endif


            <ul class="navbar-nav ms-auto align-items-center navbar-list mb-2 mb-lg-0">
                @php
                    if (Auth::check()) {
                        $get_user_data = App\Models\Cart::where('user_id', auth()->user()->id)->get();
                        $count = count($get_user_data);
                    } else {
                        $count = 0;
                    }

                @endphp

                <li class="nav-item dropdown">
                    <a href="{{ route('home') }}" class="nav-link" id="notification-drop">
                        <i class="fa-solid fa-house fs-5" viewBox="0 0 18 21"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('user.product_list') }}"
                        class="nav-link {{ Route::currentRouteName() === 'user.product_list' ? 'active' : '' }}"
                        id="notification-drop">
                        <i class="fa-solid fa-bowl-food fs-5" viewBox="0 0 18 21"></i>
                    </a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="notification-drop">
                        <i class="fa-solid fa-heart fs-5" viewBox="0 0 18 21"></i>
                    </a>
                </li> --}}

                @if(Auth::check())
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="notification-drop">
                        <i class="fa-solid fa-cart-shopping fs-5 cart_models" width="18" height="21"
                            viewBox="0 0 18 21" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                        </i>
                        <span class="count">{{ $count }}</span>
                    </a>
                </li>
                @else
                    <li class="nav-item dropdown" style="margin-right: 15px;">
                        <a href="{{route('login')}}" class="nav-link" id="notification-drop">
                            <i class="fa-solid fa-cart-shopping fs-5 cart_models" width="18" height="21"
                                viewBox="0 0 18 21" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                            </i>
                            <span class="count">{{ $count }}</span>
                        </a>
                    </li>
                @endif


                {{-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-bell fs-5" width="18" height="21" viewBox="0 0 18 21"></i>
                    </a>
                    <div class="sub-drop dropdown-menu dropdown-menu-end p-0" aria-labelledby="notification-drop">
                        <div class="card shadow-none m-0">
                            <div class="card-header d-flex justify-content-between bg-primary mx-0 px-4">
                                <div class="header-title">
                                    <h5 class="mb-0 text-white">All Notifications</h5>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <a href="#" class="iq-sub-card">
                                    <div class="d-flex align-items-center">
                                        <img class="avatar-40 rounded-pill" src="images/layouts/01.png" alt="">
                                        <div class="ms-3 w-100">
                                            <h6 class="mb-0 ">Emma Watson Bni</h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">95 MB</p>
                                                <small class="float-end font-size-12">Just Now</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="iq-sub-card">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <img class="avatar-40 rounded-pill" src="images/layouts/02.png"
                                                alt="">
                                        </div>
                                        <div class="ms-3 w-100">
                                            <h6 class="mb-0 ">New customer is join</h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Cyst Bni</p>
                                                <small class="float-end font-size-12">5 days ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="iq-sub-card">
                                    <div class="d-flex align-items-center">
                                        <img class="avatar-40 rounded-pill" src="images/layouts/03.png"
                                            alt="">
                                        <div class="ms-3 w-100">
                                            <h6 class="mb-0 ">Two customer is left</h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Cyst Bni</p>
                                                <small class="float-end font-size-12">2 days ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="iq-sub-card">
                                    <div class="d-flex align-items-center">
                                        <img class="avatar-40 rounded-pill" src="images/layouts/04.png"
                                            alt="">
                                        <div class="w-100 ms-3">
                                            <h6 class="mb-0 ">New Mail from Fenny</h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Cyst Bni</p>
                                                <small class="float-end font-size-12">3 days ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </li> --}}
                <li class="nav-item dropdown">
                    @if (Auth::check())
                        <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('images/avatars/01.png') }}" alt="User-Profile"
                                class="img-fluid avatar avatar-50 avatar-rounded">
                            <div class="caption ms-3 d-none d-md-block ">
                                <h6 class="mb-0 caption-title">{{ Auth::user()->first_name }}
                                    {{ Auth::user()->last_name }}</h6>
                                <p class="mb-0 caption-sub-title">Marketing Administrator</p>
                            </div>
                        </a>
                    @else
                    <a  href="{{route('login')}}"  class="btn btn-outline-primary square iq-col-masonry-block">
                        Login</a>
                    @endif


                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        {{-- attention:  --}}
                        <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{route('privacypolicy')}}">Privacy Setting</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>



    </div>
</nav>
<style>
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 520px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }

    .modal.right.fade .modal-dialog {
        right: -0px;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
        right: 0;
    }
</style>
@php
    if (Auth::check()) {
        $cart_data = App\Models\Cart::where('user_id', Auth::user()->id)->get();
        $cart_product = [];
        $sum = [];
        foreach ($cart_data as $cart_datas) {
            $get_product = App\Models\Product::where('id', $cart_datas->product_id)->get();
            foreach ($get_product as $get_products) {
                $cart_datas['product_name'] = $get_products->name;
                $cart_datas['product_price'] = $get_products->final_price;
                $cart_datas['product_id'] = $get_products->id;
            }
            // unset($get_product);
            $imgs = $get_products->image;
            foreach ($imgs as $imgs) {
                if ($imgs->field_name == 'product_thumbnail') {
                    $cart_datas['thumbnail'] = $imgs->path;
                }
            }
            unset($get_products->image);
            $get_addon = json_decode($cart_datas->addons_id);
            if ($get_addon) {
                $abc = [];
                foreach ($get_addon as $addon) {
                    $abc[] = \App\Models\Addons::where('id', $addon)
                        ->get()
                        ->first();
                }
                foreach ($abc as $get_addons) {
                    $addon_price[] = $get_addons->price;
                }
                $cart_datas['addon_total'] = array_sum($addon_price);
            }
            $total_cart_product = $cart_datas->product_price * $cart_datas->quantity;
            $sum[] = $total_cart_product;
            $cart_product[] = $cart_datas;
        }
        $cart_datas['total'] = array_sum($sum);
    }

@endphp
@if (Auth::check())

    <div class="modal right fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content" style="border-radius: 0px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">My Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-lg-12">
                        <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                            data-iq-duration=".6" data-iq-delay="1.2" data-iq-trigger="scroll" data-iq-ease="none">
                            <div class="card-body">
                                @if (!$cart_product)
                                    <div style="margin-left: 50px;">
                                        <img src="{{ asset('images/empty_cart.png') }}" class=""
                                            alt="img" style="width: 320px;">
                                        <h4 class="list-main">Your cart is currently empty</h4>
                                    </div>
                                @endif
                                @php
                                    $all_product_total = [];
                                @endphp
                                @foreach ($cart_product as $cart_products)
                                    <div
                                        class="rounded-pill bg-soft-primary iq-my-cart delete-id{{ $cart_products->id }}">
                                        <div class="d-flex align-items-center justify-content-between profile-img4">
                                            <div class="profile-img11">
                                                <img src="{{ asset('images/product/thumbnail/' . $cart_products->thumbnail) }}"
                                                    class="img-fluid rounded-pill avatar-115 blur-shadow position-end"
                                                    alt="img">
                                                <img src="{{ asset('images/product/thumbnail/' . $cart_products->thumbnail) }}"
                                                    class="img-fluid rounded-pill avatar-115" alt="img"
                                                    data-iq-gsap="onStart" data-iq-opacity="0" data-iq-scale=".6"
                                                    data-iq-rotate="180" data-iq-duration="1" data-iq-delay="1"
                                                    data-iq-trigger="scroll" data-iq-ease="none">
                                            </div>
                                            <div class="d-flex align-items-center profile-content">
                                                <div>
                                                    <a href="{{ route('user.product', $cart_products->product_id) }}">
                                                        <h6 class="mb-1 heading-title fw-bolder">
                                                            {{ $cart_products->product_name }}</h6>
                                                    </a>
                                                    <span class="d-flex align-items-center "><svg width="10"
                                                            height="10" viewBox="0 0 10 10" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect x="0.875" y="2.05469" width="1.66667"
                                                                height="10" rx="0.833333"
                                                                transform="rotate(-45 0.875 2.05469)"
                                                                fill="#EA6A12" />
                                                            <rect x="2.05469" y="9.125" width="1.66666"
                                                                height="10" rx="0.833332"
                                                                transform="rotate(-135 2.05469 9.125)"
                                                                fill="#EA6A12" />
                                                        </svg><small
                                                            class="text-dark ms-1">{{ $cart_products->quantity }}</small>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="me-4 text-end">
                                                <a href="javascript:void(0)" class="delete_product"
                                                    delete-product="{{ $cart_products->id }}">
                                                    <span class="mb-1">
                                                        <svg width="20" height="20" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.4"
                                                                d="M19.6449 9.48924C19.6449 9.55724 19.112 16.298 18.8076 19.1349C18.6169 20.8758 17.4946 21.9318 15.8111 21.9618C14.5176 21.9908 13.2514 22.0008 12.0055 22.0008C10.6829 22.0008 9.38936 21.9908 8.1338 21.9618C6.50672 21.9228 5.38342 20.8458 5.20253 19.1349C4.88936 16.288 4.36613 9.55724 4.35641 9.48924C4.34668 9.28425 4.41281 9.08925 4.54703 8.93126C4.67929 8.78526 4.86991 8.69727 5.07026 8.69727H18.9408C19.1402 8.69727 19.3211 8.78526 19.464 8.93126C19.5973 9.08925 19.6644 9.28425 19.6449 9.48924"
                                                                fill="#E60A0A" />
                                                            <path
                                                                d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z"
                                                                fill="#E60A0A" />
                                                        </svg>
                                                    </span>
                                                </a>
                                                @php
                                                    $product_total_price = $cart_products->product_price * $cart_products->quantity;
                                                    $addons_total_price = $cart_products->addon_total * $cart_products->quantity;
                                                    $total_product_price = $product_total_price + $addons_total_price;
                                                    $all_product_total[] = $total_product_price;
                                                @endphp
                                                <p class="mb-0 text-dark">$<span
                                                        class="total_product_price{{ $cart_products->id }}">{{ $total_product_price }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-footer" style="padding: 30px">
                    <hr class="mt-5">
                    <div class="d-flex justify-content-between align-items-center ">
                        <h4 class="list-main">Total</h4>
                        @if ($all_product_total)
                            <h4 class="heading-title fw-bolder text-primary">${{ array_sum($all_product_total) }}.00
                            </h4>
                        @else
                            <h4 class="heading-title fw-bolder text-primary">$00.00</h4>
                        @endif
                    </div>
                    <div class=" mt-3">
                        <a href="{{ route('user.view_cart') }}">
                            <button type="button" class="btn btn-secondary">View Cart</button>
                        </a>
                        <a href="{{ route('user.checkout') }}">
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<script>
    $('.delete_product').click(function() {
        var pro_id = $(this).attr('delete-product');
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        $.ajax({
            type: "GET",
            url: "{{ route('user.delete_cart_product') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": pro_id

            },
            success: function(res) {
                $(".modal-content").html(res);
            }

        });
    });
</script>

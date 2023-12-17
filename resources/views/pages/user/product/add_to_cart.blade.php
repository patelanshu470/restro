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
                    @if ($cart_product == null)
                    <div style="margin-left: 50px;">
                        <img src="{{ asset('images/empty_cart.png') }}" class="" alt="img" style="width: 320px;">
                        <h4 class="list-main">Your cart is currently empty</h4>
                    </div>
                    @endif
                    @php
                        $all_product_total = [];
                    @endphp
                    @foreach ($cart_product as $cart_products)
                    <div class="rounded-pill bg-soft-primary iq-my-cart delete-id{{ $cart_products->id }}">
                        <div class="d-flex align-items-center justify-content-between profile-img4">
                            <div class="profile-img11">
                                <img src="{{ asset('images/product/thumbnail/'.$cart_products->thumbnail) }}"
                                    class="img-fluid rounded-pill avatar-115 blur-shadow position-end"
                                    alt="img">
                                <img src="{{ asset('images/product/thumbnail/'.$cart_products->thumbnail) }}" class="img-fluid rounded-pill avatar-115"
                                    alt="img" data-iq-gsap="onStart" data-iq-opacity="0"
                                    data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1"
                                    data-iq-delay="1" data-iq-trigger="scroll" data-iq-ease="none">
                            </div>
                            <div class="d-flex align-items-center profile-content">
                                <div>
                                    <a href="{{ route('user.product',$cart_products->product_id) }}">
                                        <h6 class="mb-1 heading-title fw-bolder">{{ $cart_products->product_name }}</h6>
                                    </a>
                                    <span class="d-flex align-items-center "><svg width="10"
                                            height="10" viewBox="0 0 10 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="0.875" y="2.05469" width="1.66667"
                                                height="10" rx="0.833333"
                                                transform="rotate(-45 0.875 2.05469)" fill="#EA6A12" />
                                            <rect x="2.05469" y="9.125" width="1.66666"
                                                height="10" rx="0.833332"
                                                transform="rotate(-135 2.05469 9.125)" fill="#EA6A12" />
                                        </svg><small class="text-dark ms-1">{{ $cart_products->quantity }}</small>
                                    </span>
                                </div>
                            </div>
                            <div class="me-4 text-end">
                                <a href="javascript:void(0)" class="delete_product" delete-product="{{ $cart_products->id }}">
                                    <span class="mb-1" >
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
                                    $product_total_price = $cart_products->product_price*$cart_products->quantity;
                                    $total_product_price = $product_total_price+$cart_products->addon_total;
                                    $all_product_total[] = $total_product_price;
                                @endphp
                                <p class="mb-0 text-dark">$<span class="total_product_price{{ $cart_products->id }}">{{ $total_product_price }}</span></p>
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

            <h4 class="heading-title fw-bolder t  ext-primary">${{ array_sum($all_product_total) }}</h4>
            @else
            <h4 class="heading-title fw-bolder t  ext-primary">$00.00</h4>

            @endif
            </div>
        <div class=" mt-3">
            <a href="{{ route('user.view_cart') }}">
                <button type="button" class="btn btn-secondary">View Cart</button>
            </a>
            <button type="submit" class="btn btn-primary">Checkout</button>
        </div>
        </div>
    </div>
</div>

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
                $("#exampleModalScrollable").html(res);
            }

        });
    });
</script>

<script>
    var count_total_cart_products = "{{ count($cart_product) }}";
    $(document).ready(function(){
        $('#notification-drop .count').text(count_total_cart_products);

    });
</script>

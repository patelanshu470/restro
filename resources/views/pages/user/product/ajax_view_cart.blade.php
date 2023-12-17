<div class="content-inner mt-5 py-0">

    @if (!$cart_product)
      <div class="checkout-items">
          <div class="card text-center">
              <div class="card-body">
                  <a href="#">
                      <img src="{{ asset('images/empty_view_card-removebg-preview.png') }}" alt="img-placeholder" />
                      <h4 class=" card-title">Your cart is currently empty</h4>
                  </a>
              </div>
          </div>
      </div>
    @endif

      <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
          <div id="place-order" class="list-view product-checkout">
              <!-- Checkout Place Order Left starts -->
              @if (!$cart_product)
                  {{-- <div class="checkout-items">
                      <div class="card text-center">
                          <div class="card-body">
                              <a href="#">
                                  <img src="{{ asset('images/empty_view_card-removebg-preview.png') }}"
                                      alt="img-placeholder" />
                                  <h4 class=" card-title">Your cart is currently empty</h4>
                              </a>
                          </div>
                      </div>
                  </div> --}}
              @else
                  <div class="checkout-items">
                      @foreach ($cart_product as $cart_products)
                          <div class="card ecommerce-card">
                              <div class="item-img">
                                  <a href="#">
                                      <img src="{{ asset('images/product/thumbnail/' . $cart_products->thumbnail) }}"
                                          alt="img-placeholder" />
                                  </a>
                              </div>
                              <div class="card-body">
                                  <div class="item-name">
                                      <h6 class="mb-0"><a href="#"
                                              class="text-body">{{ $cart_products->product_name }}</a></h6>
                                      <span class="item-company">By <a href="#"
                                              class="company-name">{{ $cart_products->product_category }}</a></span>
                                      <div class="item-rating">
                                          <ul class="unstyled-list list-inline">
                                              <li class="ratings-list-item"><i data-feather="star"
                                                      class="filled-star"></i></li>
                                              <li class="ratings-list-item"><i data-feather="star"
                                                      class="filled-star"></i></li>
                                              <li class="ratings-list-item"><i data-feather="star"
                                                      class="filled-star"></i></li>
                                              <li class="ratings-list-item"><i data-feather="star"
                                                      class="filled-star"></i></li>
                                              <li class="ratings-list-item"><i data-feather="star"
                                                      class="unfilled-star"></i></li>
                                          </ul>
                                      </div>
                                  </div>
                                  @if ($cart_products->product_status == 1)
                                      <span class="text-success mb-1">In Stock</span>
                                  @else
                                      <span class="text-danger mb-1">Unavailable</span>
                                  @endif
                                  @php
                                      $product_total_price = $cart_products->product_price * $cart_products->quantity;
                                      $addons_total_price = $cart_products->addon_total * $cart_products->quantity;
                                  @endphp
                                  <div class="item-quantity">
                                      <span class="quantity-title">Qty:</span>
                                      <div class="quantity-counter-wrapper">
                                          <div class="input-group" style="margin-left: 5px;">
                                              {{-- <input type="text" class="quantity-counter" value="{{ $cart_products->quantity }}" /> --}}
                                              <span class="minus minus_quantity button"
                                                  product_id="{{ $cart_products->product_id }}" cart_id="{{ $cart_products->id }}" addons_price="{{ $cart_products->addon_total }}">-</span>
                                              <input type="number" readonly
                                                  class="input input{{ $cart_products->id }}"
                                                  value="{{ $cart_products->quantity }}" min="1"
                                                  style="width: 30px;border: none; text-align: center;" name="quantity" />
                                              <span class="plus plus_quantity button"
                                                  product_id="{{ $cart_products->product_id }}" cart_id="{{ $cart_products->id }}" addons_price="{{ $cart_products->addon_total }}">+</span>
                                          </div>
                                      </div>
                                  </div>
                                  @php
                                      $addons = json_decode($cart_products->addons_id);
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
                                      <span class="delivery-date text-muted">Addons:- <span style="color:#ea6a12;">
                                              @foreach ($abc as $addonss)
                                                  {{ $addonss->name }} (${{ $addonss->price }}),
                                              @endforeach
                                          </span></span>
                                  @endif
                                  <span class="text-success">${{ $cart_products->product_price }}</span>
                              </div>
                              <div class="item-options text-center">
                                  @php
                                      $product_total_price = $cart_products->product_price * $cart_products->quantity;
                                      $addons_total_price = $cart_products->addon_total * $cart_products->quantity;
                                      $total_product_price = $product_total_price + $addons_total_price;
                                  @endphp
                                  <div class="item-wrapper">
                                      <div class="item-cost">
                                          <input type="text" value="{{ $cart_products->product_price }}"
                                              id="single_product_pridce{{ $cart_products->id }}"
                                              style="display: none">
                                          <h4 class="item-price" style="color: #ea6a12;">$<span
                                                  class="single_product_pridce{{ $cart_products->id }}">{{ $total_product_price }}</span>
                                          </h4>
                                          <p class="card-text shipping">
                                              <span class="badge rounded-pill badge-light-success">Free Shipping</span>
                                          </p>
                                      </div>
                                  </div>
                                  <button type="button" class="btn btn-light mt-1 remove-wishlist delete_product"
                                      delete-product={{ $cart_products->id }}>
                                      <i data-feather="x" class="align-middle me-25"></i>
                                      <span>Remove</span>
                                  </button>
                                  <button type="button" class="btn btn-primary btn-cart move-cart">
                                      <i data-feather="heart" class="align-middle me-25"></i>
                                      <span class="text-truncate">Add to Wishlist</span>
                                  </button>
                              </div>
                          </div>
                      @endforeach
                  </div>
              @endif
              <!-- Checkout Place Order Left ends -->

              <!-- Checkout Place Order Right starts -->

              <div class="checkout-options">
                  @if ($cart_product)
                      <div class="card">
                          <div class="card-body">
                              <hr />
                              <div class="price-details">
                                  <h6 class="price-title">Price Details</h6>
                                  <ul class="list-unstyled">
                                      <li class="price-detail">
                                          <div class="detail-title">Total MRP</div>
                                          <div class="detail-amt">$<span
                                                  class="product_total">{{ $cart_product_total }}</span></div>
                                      </li>
                                      <li class="price-detail">
                                          <div class="detail-title">Discount</div>
                                          <div class="detail-amt discount-amt text-success">
                                              ${{ $cart_product_discount }}
                                          </div>
                                      </li>
                                      <li class="price-detail">
                                          <div class="detail-title">Addons</div>
                                          <div class="detail-amt">$<span class="addons_total_all">{{ $quantity_addons_total }}</span></div>
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
                                  <hr />
                                  <ul class="list-unstyled">
                                      @php
                                          $total_price = $cart_product_total + $quantity_addons_total;
                                      @endphp
                                      <li class="price-detail">
                                          <div class="detail-title detail-total">Total</div>
                                          <div class="detail-amt fw-bolder">$<span
                                                  class="product_total_all">{{ $total_price }}</span></div>
                                      </li>
                                  </ul>
                                  <a href="{{ route('user.checkout') }}">
                                      <button type="button" class="btn btn-primary w-100 btn-next place-order">Place
                                          Order</button>
                                  </a>
                              </div>
                          </div>
                      </div>
                  @endif

                  <!-- Checkout Place Order Right ends -->
              </div>
          </div>
          <!-- Checkout Place order Ends -->
      </div>
      {{-- </div>
    </div> --}}
  </div>
<script>
    $(function() {
 $('.button').on('click', function() {
     var $button = $(this);
     var $parent = $button.parent();
     var oldValue = $parent.find('.input').val();

   if ($button.text() == "+") {
      var newVal = parseFloat(oldValue) + 1;
    } else {
       // Don't allow decrementing below zero
      if (oldValue > 1) {
        var newVal = parseFloat(oldValue) - 1;
        } else {
        newVal = 1;
      }
      }
    $parent.find('.input').val(newVal);
 });
});
</script>

<script>
    $('.plus').on('click', function() {
        var pro_id = $(this).attr('product_id');
        var id = $(this).attr('cart_id');
        var addons_price = $(this).attr('addons_price');
        // alert(addons_price);
        // var quantity = $('.input'+ pro_id).val();
        // var quantity = parseInt(quantity) + 1;
        var product_price = $('#single_product_pridce' + id).val();
        var total = $('.single_product_pridce' + id).text();
        var product_plus = product_price * 1;
        if (addons_price == "") {
            var final = product_plus + parseInt(total);
        } else {
            var addons_tatol = product_plus + parseInt(addons_price);
            var final = addons_tatol + parseInt(total);
        }
        $('.single_product_pridce' + id).text(final);
        $.ajax({
            type: "GET",
            url: "{{ route('user.view_cart_product_incr') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id

            },
            dataType: 'json',
            success: function(data) {
                $('.product_total').html('<span class=""> ' + data.total_value + ' </span>');
                $('.product_total_all').html('<span class=""> ' + data.total + ' </span>');
                $('.addons_total_all').html('<span class=""> ' + data.addons_all_total + ' </span>');
            }

        });
    });
</script>
<script>
    $('.minus').on('click', function() {
        var pro_id = $(this).attr('product_id');
        var id = $(this).attr('cart_id');
        var quantity = $('.input' + id).val();
        var addons_price = $(this).attr('addons_price');
        if (quantity > 1) {
            var quantity = parseInt(quantity) - 1;
            var product_price = $('#single_product_pridce' + id).val();
            var total = $('.single_product_pridce' + id).text();

            if (addons_price == "") {
                var final = total - product_price;
            } else {
                var subfinal = total - parseInt(addons_price);
                var final = subfinal - product_price;
            }
            $('.single_product_pridce' + id).text(final);
            $.ajax({
                type: "GET",
                url: "{{ route('user.view_cart_product_decr') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id

                },
                dataType: 'json',
                success: function(data) {
                    $('.product_total').html('<span class=""> ' + data.total_value + ' </span>');
                    $('.product_total_all').html('<span class=""> ' + data.total + ' </span>');
                }

            });
        }
    });
</script>
<script>
    $('.delete_product').click(function() {
            var product_del_id = $(this).attr('delete-product');
        $.ajax({
            type: "GET",
            url: "{{route('user.delete_view_cart_product')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": product_del_id
            },
            success: function(res) {
                $(".content-inner").html(res);
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

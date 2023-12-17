@extends('layouts/contentLayoutMaster')
@section('title', 'Product')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <style>
        .checked {
            color: rgb(234, 106, 18);
        }
        

        span.fa {
            font-size: 13px;
        }

        /* Tooltip Styles */
        .custom-tooltip {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tooltip-content {
            position: absolute;
            visibility: hidden;
            background-color: #333;
            color: #fff;
            padding: 5px;
            border-radius: 4px;
            font-size: 14px;
            white-space: normal;
            word-wrap: break-word;
            z-index: 999;
            width: 500px;
            height: auto;
            /* overflow: hidden;  */
            bottom: calc(100% + 10px);
        }

        .custom-tooltip:hover .tooltip-content {
            visibility: visible;
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
                                <h4 class="card-title">Product Reviews</h4>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <div class="table-responsive">
                         
                                <table id="dataTableList" class="table datatables-basic" role="grid">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Product</th>
                                            <th>User</th>
                                            <th>Image</th>
                                            <th>Review</th>
                                            <th>Rating</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($productReview as $reviews)
        <div class="modal fade bs-example-modal-lg "  id="review_image_view{{ $reviews->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Review Image</h4>
                        {{-- <button type="button" class="close" data-bs-dismiss="modal">×</button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{ asset('images/review_image/' . $reviews->image) }}" alt=""
                                    width="300">
                            </div>
                            <div class="col-lg-6">
                                <div class="thumb" style="display: flex;">
                                    {{-- <img src="{{ asset('public/frontend/assets/imgs/page/no_image.png') }}" alt="" style="width: 40px;border-radius: 50%;margin-right: 5px;"> --}}
                                    <h4 style="align-self:center"><a href="#">{{ $reviews->user->first_name }}
                                            {{ $reviews->user->last_name }}</a></h4>
                                </div>
                                <div style="margin-left: 6px">
                                    @if ($reviews->rating == 1)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                    @endif
                                    @if ($reviews->rating == 2)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                    @endif
                                    @if ($reviews->rating == 3)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                    @endif
                                    @if ($reviews->rating == 4)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                    @endif
                                    @if ($reviews->rating == 5)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    @endif
                                </div>
                                <div>
                                    <h6>{{ $reviews->product->name }}</h6>
                                </div>
                                <p>{{ $reviews->description }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('page-script')
    <script>
        restroproductreviewstatus = "{{ route('restro.productreviewstatus') }}";
    </script>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script>
        function deleteRecord(id) {
            Swal.fire({
                title: 'Confirmation!',
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085D6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('del' + id).click();
                } else
                    return false;
            });
        }
    </script>
    <script>
        // Initialize tooltips on page load
        document.addEventListener("DOMContentLoaded", function() {
            const tooltips = document.querySelectorAll(".custom-tooltip");
            tooltips.forEach(function(tooltip) {
                tooltip.addEventListener("mousemove", handleTooltipPosition);
                tooltip.addEventListener("mouseleave", hideTooltip);
            });
        });

        // Position the tooltip based on mouse movement
        function handleTooltipPosition(e) {
            const tooltipContent = this.querySelector(".tooltip-content");
            tooltipContent.style.top = e.clientY + "px";
            tooltipContent.style.left = e.clientX + "px";
        }

        // Hide the tooltip when mouse leaves
        function hideTooltip() {
            const tooltipContent = this.querySelector(".tooltip-content");
            tooltipContent.style.visibility = "hidden";
        }
    </script>
    <script>
        reviewlistindex = "{{ route('restaurant.review.index') }}";
    </script>
    <script src="{{ asset('js/scripts/restaurant/productReview.js') }}"></script>
    {{-- <script src="{{asset('js/module/auth.js')}}"></script> --}}
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

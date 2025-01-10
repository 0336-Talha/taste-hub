@extends('admin.layouts.layoutsHome.app')

@section('content')
<div class="main p-4">
    <div class="container sm">
        <h3 class="mb-4">Track Order</h3>
        
        <!-- Button to send email -->
        <button class="btn btn-danger mb-4" id="esend" data-id="{{ $orders->id }}">
            <i class="bi bi-envelope"></i> Send Email to the Seller
        </button>

        <div class="row">
            <!-- Product Information Section -->
            <div class="col-lg-12 mb-4">
                <div class="row">
                    @foreach($orders->items as $item)
                        <!-- Single Product Row -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <!-- Product Image and Title -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="image me-3">
                                            <img style="width: 100px; height: 100px;" src="{{ asset($item->product->firstPhoto->photo_path) }}" alt="Product Photo" class="img-fluid rounded">
                                        </div>
                                        <div class="title">
                                            <p class="fw-bold">{{ $item->product->title }}</p>
                                        </div>
                                    </div>

                                    <!-- Product Info Table -->
                                    <table class="table table-sm table-borderless">
                                        <tbody>
                                            <tr>
                                                <td><strong>Price</strong></td>
                                                <td>${{ $item->offerPrice ? $item->offerPrice:$item->product->price }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Quantity</strong></td>
                                                <td>{{ $item->qty }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Category</strong></td>
                                                <td>{{ $item->product->subCategory->mainCategory->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Sub Category</strong></td>
                                                <td>{{ $item->product->subCategory->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Brand</strong></td>
                                                <td>{{ $item->product->brand->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Color</strong></td>
                                                <td>
                                                    <div style="background-color: {{$item->orderColor->color}}; width: 50px; height: 50px;"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Size</strong></td>
                                                <td>{{ $item->product->productSize[0]->size }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>TrackNumber: </strong></td>
                                                @if($item->trackingNumber)
                                                <td>{{ $item->trackingNumber->tracking_number }}</td>
                                                @else
                                                <td>No TrackNumber</td>
                                                @endif

                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- Address Field -->
                                    <div class="mt-4">
                                        <h6><strong>Shipping Address</strong></h6>
                                        <p>{{ $orders->name }} <br> {{ $orders->address }} <br> {{ $orders->getState->name }} {{ $orders->zip }} <br> {{ $orders->getCountry->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Order Summary</h5>
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>${{ $orders->subtotal }}</td>
                                </tr>
                                <tr>
                                    <td>Delivery</td>
                                    <td>$0.00</td>
                                </tr>
                                <tr>
                                    <td>Taxes</td>
                                    <td>$0.00</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td><strong>Total</strong></td>
                                    <td><strong>${{ $orders->total }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tracking Information Form -->
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Tracking Information</h5>
                        <form id="trackingForm">
                            @csrf
                            <input type="hidden" name="itemid" id="itemid" value="{{ $orders->id }}">
                            <div class="mb-3">
                                <textarea name="trackNo" id="trackNo" rows="5" class="form-control" placeholder="Enter tracking number..."></textarea>
                            </div>
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Handle form submission for tracking number
        $('#trackingForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this)[0];
            var formData = new FormData(form);
            let track = $('#trackNo');
            let tabtrack = $('#tabtrackNo');

            $.ajax({
                url: '/admin/updateAdminTracking',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Tracking number updated successfully.');
                    tabtrack.text(track.val());
                },
                error: function(xhr, status, error) {
                    alert('An error occurred. Please try again.');
                    console.error(error);
                }
            });
        });

        // Handle the "Send Email to Seller" button click
        $('#esend').click(function() {
            let id = $(this).data("id");
            $.ajax({
                url: "/admin/sendEmailToUser",
                type: "GET",
                data: { id },
                success: function(response) {
                    alert('Email sent to the seller.');
                    console.log("Response: ", response);
                },
                error: function(xhr, status, error) {
                    console.error("Error: ", error);
                }
            });
        });
    });
</script>
@endsection

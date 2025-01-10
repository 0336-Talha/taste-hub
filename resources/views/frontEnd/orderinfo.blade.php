@extends('frontEnd.layout.site-master')

@section('content')

<section id="track">
    <div class="contain sm">
        <h3 class="mb-4">Track Order</h3>
        <div class="row form_row">
            <div class="col-sm-12 d-flex">
                
            </div>
            <div class="col-sm-6 d-flex" >
                <div class="inner w-100" style="margin-bottom: 50px">
                    <h5 class="mb-4">Product Information</h5>
                    @php $sum=0; @endphp
                    @foreach ($orders->items as $key=>$item)
                    {{-- @if($item->product_id == $item->product->firstPhoto->product_id) --}}
                         <div class="inner_flex order_detail_detail" >
                        <div class="image" >
                            <img src="{{ asset($item->product->firstPhoto->photo_path) }}" alt="Product Photo">
                        
                        </div>
                        <div class="title">
                            <p>{{$item->product->title}}</p>
                        </div>
                    </div>
                    {{-- @endif --}}
                    
                    <table class="ship_info_tbl mt-4">
                        <tbody>
                            <tr>
                                <td><strong class="fw_600">Price</strong></td>
                                <td>${{ $item->offerPrice ? $item->offerPrice : $item->product->price }}</td>
                                @php $sum= $sum + $item->product->price * $item->qty; @endphp
                            </tr>
                            <tr>
                                <td><strong class="fw_600">Quantity</strong></td>
                                <td>{{$item->qty}}</td>
                            </tr>

                            <tr>
                                <td><strong class="fw_600">Category</strong></td>
                                <td>{{$item->product->subCategory->mainCategory->name}}</td>
                            </tr>

                            <tr>
                                <td><strong class="fw_600">Sub Category</strong></td>
                                <td>{{$item->product->subCategory->name}}</td>
                            </tr>
                            <tr>
                                {{-- <td><strong class="fw_600">Brand</strong></td>
                                <td>{{$order->product->brand->name}}</td> --}}
                            </tr>
                            <tr>
                                <td><strong class="fw_600">Color</strong></td>
                                {{-- <td>{{$order->product->productColors[0]->color}}</td> --}}
                                <td><div style="background-color:{{$item->product->getProductCol->color}}; width=100px; height=100px">#</div></td>
                            </tr>
                            <tr>
                                <td><strong class="fw_600">Size</strong></td>
                                <td>{{$item->product->getProductSiz->size}}</td>
                            </tr>

                            <tr>
                                <td><strong class="fw_600">Tracking Number</strong></td>
                                @php
                            //    $track='';
                            $track=Null;
                                if($item->trackingNumber){
                                if($item->product->user_id== Auth::user()->id){
                                 $track=$item->trackingNumber->tracking_number; 
                                }
                            }
                                @endphp
                                {{-- {{$track}} --}}
                                
                                <td>{{ $item->trackingNumber == Null  ? "Not yet Tracking Number" : $item->trackingNumber->tracking_number}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-6 d-flex">
                <div class="inner w-100">
                    <h5>Shipment Information</h5>
                    <table class="ship_info_tbl">
                        <tbody>
                            {{-- <tr>
                                <td><strong class="fw_600">Delivery Method</strong></td>
                                <td>FedEx Home Delivery</td>
                            </tr> --}}
                            {{-- <tr>
                                <td><strong class="fw_600">Carrier</strong></td>
                                <td>FedEx 800-GO-FEDEX (463.3339)</td>
                            </tr> --}}
                            <tr>
                                <td><strong class="fw_600">Tracking # On your Products</strong></td>
                                {{-- <td><strong class="fw_600" id="tabtrackNo">{{$order->trackNo != Null ? $order->trackNo : "No Tracking number Till yet"}}</strong></td> --}}
                                <td><strong class="fw_600" id="tabtrackNo">{{ $track == Null  ? "Not yet Tracking Number" : $track}}</strong></td>
                            </tr>
                            {{-- @if($order->order->diff_ship != Null) --}}
                            <tr>
                                <td><strong class="fw_600">Shipping to</strong></td>
                                <td>{{$orders->name}} <br> {{$orders->address}} <br> {{$orders->getState->name}}   {{$orders->zip}} <br> 
                                    {{$orders->getCountry->name}}
                            </tr>
                            <tr>
                                <td><strong class="fw_600">Order ID</strong></td>
                                <td>9166799832560</td>
                            </tr>

                            {{-- @else --}}
              
                          
                            {{-- @endif --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 d-flex">
                <div class="inner w-100">
                    <h5>Order Summary</h5>
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td>Subtotal <small>(items)</small></td>
                                {{-- <td>${{$order->qty * $order->product->price}}</td> --}}
                            </tr>
                            <tr>
                                <td>Delivery</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <td>Taxes</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <td colspan="2">Delivery & tax for 17857</td>
                            </tr>
                            <tr class="fw_600">
                                <td>Discount</td>
                                <td>-$0.00</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>
                            <tr class="fw_700">
                                <td>Total</td>
                                {{-- aik sy ziyada product orr unka solution --}}
                                <td>$ {{ $sum}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <p>{{$item}}</p>
            <br>
            <p>{{$orders}}</p> --}}
            @foreach ($orders->items as $ito)
            @if(  $ito->product->user_id == Auth::user()->id)
            <div class="col-sm-12 d-flex">
                <div class="inner w-100">
                    <form id="trackingForm">
                        @csrf

                    <h5 class="mb-4">Tracking Information</h5>
                    <input type="hidden" name='itemid' id='itemid' value='{{$orders->id}}'>
                    <textarea name="trackNo" id="trackNo" rows="5" class="input text_area"></textarea>
                    <div class="btn_blk mt-4">
                        <button class="site_btn">Submit</button>
                    </div>
                </form>
                </div>
            </div>
            @endif
            @endforeach

            {{-- <div class="col-sm-12 d-flex">
                <div class="inner w-100">
                    <h5 class="mb-4">Review</h5>
                    <div class="review_blk">
                        <div class="review_flex">
                            <div class="image">
                                <img src="assets/images/users/03.webp" alt="User Photo">
                            </div>
                            <div class="title">
                                <p>Aleena Gilbert</p>
                                <div class="rateYo"></div>
                            </div>
                        </div>
                        <div class="review_pera">
                        <p>"I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo."</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 d-flex">
                <div class="inner w-100 buyer_tracking_blk">
                    <h5 class="mb-4">Tracking Information</h5>
                    <div class="blk_tracking_inner">
                        <p><strong>FedEx 800-GO-FEDEX (463.3339)</strong></p>
                    </div>
                    <div class="btn_blk">
                        <a href="javascript:void(0)" class="site_btn pop_btn" data-popup="confirm">I've received the order</a>
                    </div>
                </div>
            </div> --}}
        </div> 
    </div>
</section>
<!-- track -->
<div class="popup offer_popup confirm_popup" data-popup="confirm">
    <div class="table_dv">
        <div class="table_cell">
            <div class="_inner">
                <div class="x_btn"></div>
                <div class="text-center">
                    <h4>Have you successfully received your order?</h4>
                    <div class="btn_blk">
                        <a href="javascript:void(0)" class="site_btn pop_btn confirm_btn_popup" data-popup="review">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="popup offer_popup confirm_popup" data-popup="review">
    <div class="table_dv">
        <div class="table_cell">
            <div class="_inner">
                <div class="x_btn"></div>
                <div class="leave_review">
                    <h4>Leave Review</h4>
                    <form action="">
                        <div class="rating_add_blk">
                            <h5>Your Rating</h5>
                            <div class="_rateYo"></div>
                        </div>
                        <div class="rating_add_blk">
                            <h5>Your Review</h5>
                            <textarea name="" id="" rows="10" class="input"></textarea>
                        </div>
                    </form>
                    <div class="btn_blk">
                        <button class="site_btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('document').ready(function(){
    // console.log('hello from script')
    $('#trackingForm').on('submit',function(e){
            e.preventDefault();
            // var form = $(this);
            var form=document.getElementById('trackingForm');
                var formData = new FormData(form);
                let track=$('#trackNo');
                // console.log(track.val());
                let tabtrack=$('#tabtrackNo');
                
                $.ajax({
                    url: '/updateTrackNo',

                    // url: '{{route('user.updateTrackNo')}}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {                      
                        alert('Your form has been sent successfully.');
                        tabtrack.text(track.val());
                    },
                    error: function (xhr, status, error) {                       
                        alert('Your form was not sent successfully.');
                        console.error(error);
                    }
                });
    })

})
</script>
@endsection
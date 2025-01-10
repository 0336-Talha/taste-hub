@extends('frontEnd.layout.site-master')

@section('content')

<section id="track">
    <div class="contain sm">
        <h3 class="mb-4">Rating And Review</h3>
        @php $price=0; @endphp
    
            
   
        <div class="row form_row">
            <div class="col-sm-12 d-flex">
                
            </div>
            @if($order != Null)
            @foreach ($order->order->items as $item)
                
          
            <div class="col-sm-6 d-flex">
                <div class="inner w-100">
                    <h5 class="mb-4">Product Information</h5>
                    <div class="inner_flex order_detail_detail">
                        <div class="image">
                            <img src="{{ asset($item->product->firstPhoto->photo_path) }}" alt="Product Photo">
                        </div>
                        <div class="title">
                            <p>{{$item->product->title}}</p>
                        </div>
                    </div>
                    <table class="ship_info_tbl mt-4">
                        <tbody>
                            <tr>
                                <td><strong class="fw_600">Price</strong></td>
                                <td>${{$item->product->price}}</td>
                            </tr>
                            <tr>
                                <td><strong class="fw_600">Quantity</strong></td>
                                <td>{{$item->qty}}</td>
                            </tr>
                            <tr>
                                <button class="btn btn-primary addReview" id="addReview" style="width:100%" data-productid="{{$item->product_id}}" data-orderid="{{$item->order_id}}"
                                    data-rate="{{isset($item->product->productReview) && $item->product->productReview ? $item->product->productReview->rating : '' }}"
                                    {{-- data-rate="{{$item->product->productReview->rating == Null ? "No Rating" : $item->product->productReview->rating }}" --}}

                                    {{-- data-com="{{$item->product->productReview->comment == Null ? "" : $item->product->productReview->comment }}"
                                    > --}}
                                    data-com="{{ isset($item->product->productReview) && $item->product->productReview ? $item->product->productReview->comment : '' }}">
    
                                    Add or Update Review Ratings.</button>  
                                {{-- <div id="star-rating"></div> --}}
                                  {{-- <input type="number" name="rating" id="rating" style="width: 100px" class="rating-input"> --}}
                               <!-- Success Message (Initially Hidden) -->
                <div id="successMessage" class="successMessage" hidden style=" color: green; text-align: center; font-weight: bold;">
                             Successfully Added
                        </div>
                            </tr>

                 
                        </tbody>
                    </table>

                </div>
            </div>
            @endforeach


            <div class="modal fade" id="ajaxModel" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalHeading"></h4>
                        </div>
                        <div class="modal-body">
                
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
                </div>

                    
            <div class="col-sm-6 d-flex">
                <div class="inner w-100">
                    <h5>Shipment Information</h5>
                    <table class="ship_info_tbl">
                        <tbody>
                     
                            <tr>
                                <td><strong class="fw_600">Tracking #</strong></td>
                                <td><strong class="fw_600" id="tabtrackNo">
                                
                                {{$order->trackingNumber  != Null ?  $order->trackingNumber->tracking_number : 
                                "No Tracking number Till yet"}}</strong></td>
                            </tr>
                            @if($order->order->diff_ship != Null)
                            <tr>
                                <td><strong class="fw_600">Shipping to</strong></td>
                                <td>Ben Mishkin <br> 7004 E Ohio Drive <br> Denver, CO 80224</td>
                            </tr>
                            <tr>
                                <td><strong class="fw_600">Order ID</strong></td>
                                <td>9166799832560</td>
                            </tr>

                            @else
                            <tr>
                                <td><strong class="fw_600">Shipping to</strong></td>
                                <td>{{$order->order->name}} <br> {{$order->order->address}} <br> {{$order->order->getState->name}}   {{$order->order->zip}} <br>
                                    {{$order->order->getCountry->name}}
                                </td>
                            </tr>
                            <tr>
                                <td><strong class="fw_600">Order ID</strong></td>
                                <td>{{$order->id}}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
         
            @php
            
              @endphp
          
        

            <div class="col-sm-12 d-flex">
                <div class="inner w-100">
                    <h5>Order Summary</h5>
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td>Subtotal <small>(items)</small></td>
                                {{-- <td>${{$price}}</td> --}}
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
                                {{-- <td>${{$price}}</td> --}}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-sm-12 d-flex">
                <div class="inner w-100">
                    <h5 class="mb-4">Review</h5>
                    <div class="review_blk">
                        <div class="review_flex">
                            <div class="image">
                                <img src="{{asset( $order->order->items[0]->product->productuser == Null ? 'adminimage.jpg' : $order->order->items[0]->product->productuser->photo)}}" alt="User Photo">

              
                            </div>
                            <div class="title">
                                <p>{{$order->order->items[0]->product->productuser == Null ? 'Admin': $order->order->items[0]->product->productusername->name}}</p>
                                {{-- {{$order->order->items[0]->product->owner_rating->rating}} --}}
                                {{-- <div class="rateYo"></div> --}}
                                {{-- {{ isset($order->order->items[0]->product->productusername->owner_rating) && 
                                $order->order->items[0]->product->productusername->owner_rating->rating == Null &&
                                $order->order->items[0]->product->owner_rating->rating == Null
                                ?
                                 $order->order->items[0]->product->owner_rating->rating : "" }} --}}
                                    @php
                                    $r='0';
                                    $m='No Comment';

                                    $rate=$order->order->items[0]->product;
                                    // ->productusername->ownerRating;
                                    // dd($rate);
                                    if($rate->productusername != Null){
                                        $rate=$order->order->items[0]->product->productusername->ownerRating;
                    
                                    }else{
                                        $rate=$order->order->items[0]->product->owner_rating;
                                        // echo $rate;
                                    }

                                // echo $rate->rating;
                                if(isset($rate->rating)){
                                if($rate->rating != Null){
                                    $r=$rate->rating;
                                }
                                if($rate->comment != Null){
                                    $m=$rate->comment;
                                }
                            }
                                    // echo $r.''.$m;
                                    
                                    @endphp
                                <button class="btn btn-primary addOwnerReview" id="addOwnerReview"  
                                data-id="{{$order->order->items[0]->product->productusername == Null ? '': $order->order->items[0]->product->productusername->id}}"
                                {{-- data-rate="{{isset($item->product->productReview) && $item->product->productReview ? $item->product->productReview->rating : '' }}" --}}
                              {{-- data-rate="
                            {{  isset($order->order->items[0]->product->productusername) && 
                              isset($order->order->items[0]->product->productusername->owner_rating) && 
                              $order->order->items[0]->product->productusername->owner_rating->rating !== null
                              ? $order->order->items[0]->product->productusername->owner_rating->rating 
                              : (isset($order->order->items[0]->product->owner_rating) && $order->order->items[0]->product->owner_rating->rating !== null 
                                  ? $order->order->items[0]->product->owner_rating->rating 
                                  : "") }}
                              " --}}
                              data-rate="{{$r}}"
                                data-msg="{{$m}}"

                              {{-- data-com="
                              {{ isset($order->order->items[0]->product->productusername) && 
                               isset($order->order->items[0]->product->productusername->owner_rating) && 
                               $order->order->items[0]->product->productusername->owner_rating->comment !== null
                               ? $order->order->items[0]->product->productusername->owner_rating->comment 
                               : (isset($order->order->items[0]->product->owner_rating) && $order->order->items[0]->product->owner_rating->comment !== null 
                                   ? $order->order->items[0]->product->owner_rating->comment
                                   : "") }}
                               " --}}

                                {{-- data-com="{{ isset($item->product->productReview) && $item->product->productReview ? $item->product->productReview->comment : '' }}"> --}}
                                >

                                Add or Update Product Owner Review Ratings.</button> 
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
                    <h5 class="mb-4">Your product Owner Review</h5>
                    <div class="blk_tracking_inner">
                        <p>
                        <strong><img style="height: 40px; width:40px" src="{{asset($order->order->orderMaker->photo)}}" alt="no_photo">{{$m}}</strong><br>Rating: {{$r}}</p>
                    </div>
                    <div class="btn_blk">
                        <a href="javascript:void(0)" class="site_btn pop_btn" data-popup="confirm">I've received the order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <h6 class="text-center">You Are on the Wrong Page</h6>
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
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text(rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
            $(this).parent().find('#rating').val(rating);
        });

        // let token={{csrf_token()}}
            //  formData.append('_token', token);


        


        let current;
        let message;
        $('.addReview').on('click',function(){
            let id=$(this).attr("data-productid");
            let orderid=$(this).attr("data-orderid");
             current=$(this);
             message=$(this).parent().children('#successMessage');
            //  console.log(message);
            
            let rate=$(this).attr("data-rate");
          let d=0;
        
           if(rate==''){
               d=4;
               console.log(d)
           }else{
            d=rate;
           }
            let com=$(this).attr("data-com");

            console.log(rate)
            console.log(com)


            // var editProductUrl = "{{ route('user.productReviewStore', ':id') }}";
             $('#modalHeading').html('Please Add Review And Ratings');
            //  let url = editProductUrl.replace(':id', id);
            //  console.log(url);

            let formHtml = `
            <form class="rating-form"  method="POST">
                                    @csrf
 
                                <input type="hidden" name="product_id" id='product_id'   value="${id}">
                                <input type="hidden" name="order_id" id='order_id'  value="${orderid}">

                               <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                <p>Review Stars</p>
                                 <br>
                                 <div class="rateyo" id= "rating"
                                 data-rateyo-rating="${d}"
                                 data-rateyo-num-stars="5"
                                 data-rateyo-score="3">
                                </div>
                            
                               <span class='result'>
                                ${rate}
                           </span> 
                           <input type="hidden" id='rating' name="rating"> 
                           
                                    
                            <textarea name="description"id="description" class="form-control" placeholder="Write your review">${com}</textarea> 
                                     
                           <button type="submit" class="btn btn-primary">Submit</button>
                        </form>  
    `;

    $('.modal-body').html(formHtml);
    $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text(rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
            $(this).parent().find('#rating').val(rating);
        });

    $('#ajaxModel').modal('show');



        })

        $(document).on('submit','.rating-form',function(e) {
        // $(document).on('.rating-form','submit',function(e){
            // let btn=$(this).parent().parent();
            // console.log(btn);
            e.preventDefault();

           let a= $(this).find('#rating').val();
           console.log(a)
            // console.log(a)

            if(a === ''){
                console.log('elow');
              console.log($(this).find('.result').text("Please Select Rating"));    
            }
            else{
             let formData= this;
            
             let form = new FormData(formData);

        //      form.forEach(function(value, key){
        //     console.log(key + ": " + value);
        // }); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
    
        $.ajax({
            url: "{{route('user.productReviewStore')}}",  

            type: 'POST',
           
            data: form,
            contentType: false,  // Don't set contentType for FormData
            processData: false,  // Don't let jQuery process the data
            success: function(response){
                console.log('Server Response:', response);

                $("#ajaxModel").modal('hide');
                // $('[data-productid="23"]').hide();
                // current.hide();
                
                // $(message).fadeIn().delay(50000).fadeOut();
                $(message).removeAttr("hidden"); 


                // You can handle the response from the server here
            },
            error: function(xhr, status, error){
                console.log('Error:', error);
            }
        });
            }
        });
    
        // addOwnerReview 
        $('.addOwnerReview ').on('click',function(){
            let id=$(this).attr("data-id");
            // let orderid=$(this).attr("data-orderid");
             current=$(this);
            //  message=$(this).parent().children('#successMessage');
            //  console.log(message);
            
        //     let rate=$(this).attr("data-rate");
        //   let d=0;
        
        //    if(rate==''){
        //        d=4;
        //        console.log(d)
        //    }else{
        //     d=rate;
        //    }
        //     let com=$(this).attr("data-com");

        //     console.log(rate)
        //     console.log(com)


            // var editProductUrl = "{{ route('user.productReviewStore', ':id') }}";
             $('#modalHeading').html('Please Add Review And Ratings');
            //  let url = editProductUrl.replace(':id', id);
            //  console.log(url);

            let formHtml = `
            <form class="ratings-form"  method="POST">
                                    @csrf
 
                      

                               <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                <p>Review Stars</p>
                                 <br>
                                 <div class="rateyo" id= "rating"
                                 data-rateyo-rating="4"
                                 data-rateyo-num-stars="5"
                                 data-rateyo-score="3">
                                </div>
                            
                               <span class='result'>
                              
                           </span> 
                           <input type="hidden" id='rating' name="rating"> 
                           <input type="hidden" id='ownerid' name="ownerid" value=${id}> 

                           
                                    
                            <textarea name="description"id="description" class="form-control" placeholder="Write your review"></textarea> 
                                     
                           <button type="submit" class="btn btn-primary">Submit</button>
                        </form>  
    `;

    $('.modal-body').html(formHtml);
    $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text(rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
            $(this).parent().find('#rating').val(rating);
        });

    $('#ajaxModel').modal('show');



        });


        $(document).on('submit','.ratings-form',function(e) {
      
            e.preventDefault();

           let a= $(this).find('#rating').val();
           console.log(a)
            // console.log(a)

            if(a === ''){
                console.log('elow');
              console.log($(this).find('.result').text("Please Select Rating"));    
            }
            else{
             let formData= this;
            
             let form = new FormData(formData);

        //      form.forEach(function(value, key){
        //     console.log(key + ": " + value);
        // }); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
    
        $.ajax({
            url: "{{route('user.storeAdminReview')}}",  

            type: 'POST',
           
            data: form,
            contentType: false,  // Don't set contentType for FormData
            processData: false,  // Don't let jQuery process the data
            success: function(response){
                console.log('Server Response:', response);

                $("#ajaxModel").modal('hide');
                // $('[data-productid="23"]').hide();
                // current.hide();
                
                // $(message).fadeIn().delay(50000).fadeOut();
                $(message).removeAttr("hidden"); 


                // You can handle the response from the server here
            },
            error: function(xhr, status, error){
                console.log('Error:', error);
            }
        });
            }
        });



    });
 </script>
@endsection
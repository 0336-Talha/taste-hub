@extends('frontEnd.layout.site-master')

@section('content')
{{-- @if(isset($groupedReviews[""]))
    @foreach ($groupedReviews[""] as $item)
        {{$item['rating'] ?? 'No Rating Available'}}  <!-- Fallback if rating is missing -->
    @endforeach
@else
    <p>No data available for this group.</p>
@endif --}}
{{-- @dump($groupedReviews) --}}
{{-- @dump($uniqueOwners) --}}
{{-- @foreach ($groupedReview as $item)
{{$item}}
@endforeach --}}

{{-- @dump($groupedReviews) --}}

<section id="checkout">

    <div class="contain">

        <div class="row flex_row">

            <div class="col-xl-8">

                <h3>Checkout</h3>

                <p class="opacity-50">All fields required unless otherwise noted</p>

                <div class="payment_info_blk mt-4">

                    <h5>Payment Method:</h5>

                    <div class="credit_card_bar mb-4">

                        <div class="lbl_btn align-items-center fw_600">

                            Credit Card/Debit Card

                        </div>

                        <div class="cards_fig">

                            <img src="{{asset('')}}front/assets/images/payment_visa.svg" alt="">

                            <img src="{{asset('')}}front/assets/images/payment_master.svg" alt="">

                            <img src="{{asset('')}}front/assets/images/payment_amex.svg" alt="">

                            <img src="{{asset('')}}front/assets/images/payment_discover.svg" alt="">

                        </div>

                        <small class="ms-3">and more...</small>

                    </div>

                    <form id="payment">
                    <div id="add_new_credit">

                        <div class="row form_row">
                            <div class="col-sm-6">

                                <div class="form_blk">

                                    <label for="card-number"><h6>Card Number</h6></label>

                                    <div id="card-number" class="input">

                                    </div>
                                    {{-- <input type="text"  id="card-number" class="input" placeholder="eg: 1234567899696">
                            <div id="card-errors" role="alert">hiii</div>  --}}


                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="form_blk">
                                    
                                  <label for="card-expiry">  <h6 class="require">Exp MM/ YY</h6></label>

                                    {{-- <input type="text" id="card-expiry" name=""  class="input" placeholder="eg: 12/2030"> --}}
                                    <div id="card-expiry" class="input">

                                    </div>

                                </div>

                            </div> 

                            <div class="col-sm-6">

                                <div class="form_blk">

                                    <label for="card-name"><h6>Name on Card</h6></label>

                                    <input id="card-name" type="text"   class="input" placeholder="eg: John Wick">

                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="form_blk">

                                  <label for="card-cvc">  <h6 class="require">Security Code</h6></label>

                                    {{-- <input type="text" id="card-cvc" name=""  class="input" placeholder="eg: cvc- 123"> --}}
                                    <div id="card-cvc" class="input">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    {{-- <button type="submit">Submit</button> --}}

                    <hr>
         

                    <div class="billing_address">

                        <h5>Billing Address:</h5>

                        <div class="pt-4">

                            <div class="row form_row">

                                <div class="col-sm-6">

                                    <div class="form_blk">

                                        <h6>First Name</h6>

                                        <input type="text" name="bfname" id="bfname" class="input" placeholder="eg: John">

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form_blk">

                                        <h6>Last Name</h6>

                                        <input type="text" name="blname" id="blname" class="input" placeholder="eg: Wick">

                                    </div>

                                </div>

                                <div class="col-lg-9">

                                    <div class="form_blk">

                                        <h6>Billing Address</h6>

                                        <input type="text" name="baddress" id="baddress" class="input" placeholder="eg: 123 Main Street, California">

                                    </div>

                                </div>

                                <div class="col-sm-3">

                                    <div class="form_blk">

                                        <h6 class="require">Zip Code</h6>

                                        <input type="text" name="bzip" id="bzip" class="input" placeholder="eg: BL0 0WY">

                                    </div>

                                </div>

                                <div class="col-sm-4">

                                    <div class="form_blk">

                                        <h6>City</h6>

                                        <input type="text" name="bcity" id="bcity" class="input" placeholder="eg: California">

                                    </div>

                                </div>
                                <div class="col-sm-4">

                                    <div class="form_blk">

                                        <h6>Country</h6>

                                        <select name="bcountry" id="bcountry" class="input">

                                            <option value="">Select</option>

                                            @forEach($country as $country)
                                
                                            <option value="{{$country['id']}}">{{$country['name']}}</option>
                                            
                                            @endforeach
                                            {{-- <option value="232">United Kingdom</option>

                                            <option value="232">United Kingdom</option>

                                            <option value="232">United Kingdom</option>

                                            <option value="232">United Kingdom</option>

                                            <option value="232">United Kingdom</option>

                                            <option value="232">United Kingdom</option> --}}

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-4">

                                    <div class="form_blk">

                                        <h6 class="require">State</h6>

                                        {{-- <input type="text" name="state" id="state" class="input" placeholder="eg: Sheffield"> --}}
                                        <select name="bstate" id="bstate" class="input">


                                            <option value="">Select</option>
                                            {{-- <option  hidden></option> --}}
            
                                        </select>
                                    </div>

                                </div>

                             

                            </div>

                        </div>

                    </div>

                    <hr>

                    {{-- <div class="row form_row">

                        <div class="col-sm-12">

                            <div class="lbl_btn">

                                <input type="checkbox" name="same_shipping" id="same_shipping">

                                <label for="same_shipping">Same as billing address</label>

                            </div>

                        </div> --}}

                        <div class="col-sm-12">

                            <div class="lbl_btn">

                                <input type="checkbox" name="differ_shipping" id="differ_shipping">

                                <label for="differ_shipping">Use a different shipping address</label>

                            </div>

                        </div>

                    </div>

                    <hr>
               


                <form id="billingForm">
                    <div class="billing_address">
                        {{-- disabled="true" style="pointer-events: none" --}}

                        <h5>Shipping Address:</h5>

                        

                        <div id="add_new_billing" class="pt-4">

                            <div class="row form_row">

                                <div class="col-sm-6">

                                    <div class="form_blk">

                                        <h6>First Name</h6>

                                        <input type="text" name="sfname" id="sfname" class="input" placeholder="eg: John">

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form_blk">

                                        <h6>Last Name</h6>

                                        <input type="text" name="slname" id="slname" class="input" placeholder="eg: Wick">

                                    </div>

                                </div>

                                <div class="col-lg-9">

                                    <div class="form_blk">

                                        <h6>Shipping Address</h6>

                                        <input type="text" name="saddress" id="saddress" class="input" placeholder="eg: 123 Main Street, California">

                                    </div>

                                </div>

                                <div class="col-sm-3">

                                    <div class="form_blk">

                                        <h6 class="require">Zip Code</h6>

                                        <input type="text" name="szip" id="szip" class="input" placeholder="eg: BL0 0WY">

                                    </div>

                                </div>

                                <div class="col-sm-4">

                                    <div class="form_blk">

                                        <h6>City</h6>

                                        <input type="text" name="scity" id="scity" class="input" placeholder="eg: California">

                                    </div>

                                </div>

                                <div class="col-sm-4">

                                    <div class="form_blk">

                                        <h6>Country</h6>

                                        {{-- <select name="" id="" class="input"> --}}

                                            {{-- <option value="">Select</option> --}}
                             
                                            {{-- <h6>Country</h6> --}}

                                            <select name="scountry" id="scountry" class="input">
    
                                                <option value="">Select</option>
    
                                                @forEach($scountry as $country)
                                
                                                <option value="{{$country['id']}}">{{$country['name']}}</option>
                                                
                                                @endforeach
                                                {{-- @forEach($country as $scount)
                                                <p>{{$scount['id']}}</p>
                                    
                                                {{-- <option value="{{$scountry['id']}}">{{$scountry['name']}}</option> --}}
                                                
                                                {{-- @endforeach  --}}
                                                {{-- <option value="232">United Kingdom</option>
    
                                                <option value="232">United Kingdom</option>
    
                                                <option value="232">United Kingdom</option>
    
                                                <option value="232">United Kingdom</option>
    
                                                <option value="232">United Kingdom</option>
    
                                                <option value="232">United Kingdom</option> --}}
    
                                            </select>
                                    </div>

                                </div>

                                <div class="col-sm-4">

                                    <div class="form_blk">

                                        <h6 class="require">State</h6>

                                        <select name="sstate" id="sstate" class="input">
    
                                            <option value="">Select</option>

                                        </select>

                                        {{-- <input type="text" name="sstate" id="sstate" class="input" placeholder="eg: Sheffield"> --}}

                                    </div>

                                </div>

                              

                            </div>

                        </div>

                    </div>

                    <hr>

                    <h5>Contact Info:</h5>

                    <p>Receive your order confirmation email and get updates on the status of your order.</p>

                    <p>An order confirmation email will be sent to: <b> tracksuit980@gmail.com </b></p>

                    <div class="row form_row">

                        <div class="col-sm-12">

                            <div class="form_blk">

                                <div class="lbl_btn">

                                    <input type="checkbox" name="spe_offers" id="spe_offers">

                                    <label for="spe_offers">Email me promotions and special offers</label>

                                </div>

                            </div>

                        </div>

                     
                        

                    </div>


                    <div class="btn_blk mt-5">

                        <button type="submit" id="submit-button" class="site_btn w-100">Submit Order</button>

                    </div>
                </div>

        </form>
      
            <div class="col-xl-4">

                <div class="cart_side_blk mb-4">
                  {{-- {{ $groupedReviews['']['total_reviews']}} --}}
                    <h4 class="mb-4">Seller Information</h4>
        {{-- // ownersWithReviews --}}

                    @foreach ($ownersWithReviews as $key=>$item)
                    {{-- @php
                    //  @dd($item);
                    $ownerId = $item['user_id'] ?? "";
                    $
                    $ownerReviews = $groupedReviews[$ownerId] ?? null;
                    // Find the grouped reviews for the current owner using the user_id
                    // $ownerReviews = isset($groupedReviews[$item->user_id]) ? $groupedReviews[$item->user_id] : null;
                    // $ownerReviews = isset($groupedReviews[$item['user_id']]) ? $groupedReviews[$item['user_id']] : null;
                    
                @endphp --}}
                        {{-- {{ $groupedReviews['']['average_rating']}} --}}


                    <div class="seller_info" style="margin-bottom:10px">
                            
                        <div class="ico fill round">

                            {{-- <img src="{{asset('')}}front/assets/images/users/01.webp" alt=""> --}}
                            <img src="{{asset($item['photo'])}}"  alt="nothing">


                        </div>

                        <div class="text_r">

                            <div class="name">{{$item['name']}}</div>
                            {{-- @if ($ownerId === '') 
                            {{ $ownerReviews['average_rating'] }}
                            @endif --}}
                            {{-- {{ $ownerReviews['']['total_reviews'] }} --}}
                            {{-- <div class="_rating"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/fi-sr-star.png" alt=""><span>5.0</span><span class="dim_text">(23)</span></div> --}}
                            {{-- @if($item['name']=="Admin Product") --}}
                            {{-- <div class="review-stats">

                                <p><strong>Average Rating:</strong>  {{ $groupedReviews['']['average_rating']}}</p>
                                <p><strong>Total Reviews:</strong> {{ $groupedReviews['']['total_reviews'] }}</p>
                            </div> --}}
                           @if($item['average_rating'])
                            <div class="_rating"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/fi-sr-star.png" alt=""><span>{{ $item['average_rating']}}</span><span class="dim_text">({{ $item['total_reviews_count'] }})</span></div>
                            @else
                            {{-- @endif --}}
                            {{-- @if ($ownerReviews) --}}
                            {{-- <div class="review-stats">
                                <p><strong>Average Rating:</strong> {{ $ownerReviews['average_rating'] }}</p>
                                <p><strong>Total Reviews:</strong> {{ $ownerReviews['total_reviews_count'] }}</p>
                            </div> --}}

                            {{-- <div class="_rating"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/fi-sr-star.png" alt=""><span>{{ $ownerReviews['average_rating'] }}</span><span class="dim_text">({{ $ownerReviews['total_reviews_count'] }})</span></div>
                            {{-- {{ $ownerReviews[""]['average_rating'] }} --}}
                        {{-- @else --}}
                            <p>No reviews available for this owner.</p>
                        {{-- @endif --}}
                        @endif
                     

                            {{-- <div class="_rating"><img src="a{{asset('')}}front/assets/images/fi-sr-star.png" alt=""><span>5.0</span><span class="dim_text">(23)</span></div> --}}

                        </div>

                    </div>
                    @endforeach

                </div>

                <div class="top_heading side_head">

                    <h3 class="mb-3">Order Summary</h3>

                    <div class="btn_blk">

                        <a href="javascript:void(0)" class="read_more_btn" id="discount_btn">Discount or Gift Card</a>

                    </div>

                </div>

                <div class="cart_side_blk mt-4">

                    <div class="summary_cart_table">

                        <table class="w-100">

                            <tbody>
                                @php
                                 $sum = 0; // Initialize the sum variable
                                @endphp

                                @foreach($prod as $pr)
                                <tr>
                                    {{-- {{$pr->product->firstPhoto->photo_path}} --}}
                               
                                    <td>

                                        <div class="ico_blk">

                                            <div class="ico fill round"><a href="product-detail.php"><img src="{{asset($pr->product->firstPhoto->photo_path)}}" width="200" height="200" alt=""></a></div>

                                            <div class="name"><a href="product-detail.php">{{$pr->product->title}}</a></div>

                                        </div>

                                    </td>

                                    @php
                                    if($pr->product->productOffer !== Null){
                                        // echo "hello"; 
                                        if($pr->product->id == $pr->product->productOffer->product_id){
                                            $pprice=$pr->product->productOffer->offerPrice *$pr->qty;
                                        }else{
                                            $pprice=$pr->product->price * $pr->qty;
                                        }
                                    }else{
                                        $pprice=$pr->product->price * $pr->qty;
        
                                    }
                                    @endphp

                                    <td>  
                                       
  
                                        <div class="price">$ {{$pprice}}</div>
                                        @php $sum= $sum+ $pprice @endphp
                                    </td>  

                                </tr>

             
                                @endforeach
                                {{-- <p> achaaa ${{ number_format($sum, 2) }} </p> --}}

                            </tbody>

                        </table>

                    </div>

                    <table class="w-100">

                        <tbody>

                            

                            <tr>

                                <td colspan="2">

                                    <div class="free_ship"><img src="{{asset('')}}front/assets/images/icon-truck.svg" alt=""> $2.03 away from &nbsp;<strong>Free Shipping!</strong></div>

                                </td>

                            </tr>

                            <tr>

                                <td>Subtotal <small>(items)</small></td>

                                <td>${{ number_format($sum, 2) }}</td>

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

                                <td colspan="2">

                                    <div class="info_blk">

                                        <img src="assets/images/icon-info.svg" alt="">

                                        <span class="small">Estimated delivery &amp; tax for 17857</span>

                                    </div>

                                </td>

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

                                <td id="totalAmount">${{ number_format($sum, 2) }}</td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
@section('script')
<script>
console.log('heelo')


function checking(){
    let ch=$('#differ_shipping').is(':checked');
    console.log(ch)
    if(ch==false){
        $("#sfname").attr('disabled','disabled');
        $("#slname").attr('disabled','disabled');
        $("#saddress").attr('disabled','disabled');
        $("#szip").attr('disabled','disabled');
        // $("#slname").attr('disabled','disabled');
        $("#scity").attr('disabled','disabled');
        $("#scountry").attr('disabled','disabled');
        $("#sstate").attr('disabled','disabled');
    }else{
        $("#sfname").removeAttr('disabled');
        $("#slname").removeAttr('disabled');
        $("#saddress").removeAttr('disabled');
        $("#szip").removeAttr('disabled');
        $("#scity").removeAttr('disabled');
        $("#scountry").removeAttr('disabled');
        $("#sstate").removeAttr('disabled');
    }

}
checking();
$('#differ_shipping').on('change',function(){
    checking();
});

// $('#payment').on('submit',function(e){
//     // e.preventDefault();
// })
    var stripe = Stripe('pk_test_51OLrSyFz9lIBjWEqLpO6s3lMye9SZ6yPmFRJBKpr7QcrjVEpglE5IILHC8k3ZdmfujnVAJwnhfvAoYH8s4Kiqd7R00Fk3nabZT'); // Your Stripe public key);
    var elements = stripe.elements();
    console.log(elements)

    var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

// Card Number
var cardNumber = elements.create('cardNumber', {style: style});
console.log(cardNumber)
cardNumber.mount('#card-number');

// Expiration Date
var cardExpiry = elements.create('cardExpiry', {style: style});
cardExpiry.mount('#card-expiry');

// CVC
var cardCvc = elements.create('cardCvc', {style: style});
cardCvc.mount('#card-cvc');

var form = document.getElementById('payment');

form.addEventListener('submit', function(event) {
    event.preventDefault();
    document.getElementById("submit-button").disabled = true;
    
    let nameOnCard=document.getElementById('card-name').value;
    // console.log(nameOnCard);
    let amount=document.getElementById('totalAmount');
    // console.log(amount.innerText);
    amount=amount.innerText;
    let amo=amount.slice(1);
    // $(this).disable();
    let submitButton = document.getElementById('submit-button');  // Assuming your submit button has an ID 'submit-button'
    submitButton.disabled = true; 


    fetch('/paymentRequest', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
            amount:amo  // Replace with dynamic amount (in cents)
        }),
    }).then(function(response) {
        return response.json();
    }).then(function(data) {
        // Get the client secret from the response and confirm the payment
        stripe.confirmCardPayment(data.clientSecret, {
            // payment_method: {
            //     card: cardElement,
            // },
            payment_method: {
            card: cardNumber,  // Using the `cardNumber` element
        billing_details: {
            name: nameOnCard // You can add billing details if needed
        }
    },
        }).then(function(result) {
            if (result.error) {
                // Show error to your customer
                document.getElementById('error-message').textContent = result.error.message;
    submitButton.disabled = false; 

            } else {
                if (result.paymentIntent.status === 'succeeded') {
                    console.log("yes")
                    // Payment succeeded, handle success action
                    // window.location.href = '/payment-success'; // Redirect on success
                    // console.log(result);
                    //      console.log(result.paymentIntent.id);
                    // console.log(result.paymentIntent.status);

                    let paymentIntentId=result.paymentIntent.id;
                    let paymentStatus=result.paymentIntent.status;
            // let _token={{ csrf_token() }};

                    // var formData = $(this).serialize();
                    // formData.append(paymentIntentId);
                    // formData.append(paymentStatus);
                    var form = document.getElementById('payment'); // Replace with the actual form ID
                    var formData = new FormData(form);

            // Append the payment intent details
                 formData.append('paymentIntentId', paymentIntentId);
                 formData.append('paymentStatus', paymentStatus);
                 formData.append('_token','{{ csrf_token() }}');

                    $.ajax({
                        url: "{{ route('user.workOnPayment') }}", // Adjust this route as necessary
                method: 'POST',
                data: formData,
                processData: false, // Required for FormData to work correctly
                contentType: false, // Required for FormData to work correctly
                success: function(response) {
                    console.log('okay chla hai yah');
                    console.log(response)
                 if (response.status == "success") {
            console.log('Payment saved successfully:', response);

            // Redirect the user to the success page
            window.location.href = response.redirectUrl;
        } else {
            alert('Payment failed. Please try again.');
    document.getElementById("submit-button").disabled = false;

        }
    },
                error: function(error) {
                    console.log('Error:', error);
                    alert('An error occurred.');
    document.getElementById("submit-button").disabled = false;

                }
    });

    // -------------------------
                }
            }
        });
    });

})

$(document).on('change','#bcountry',function(){
            let id=$(this).val();
            // console.log(id);
            let opt=$('#bstate');
            // "_token": "{{ csrf_token() }}"
            // console.log(opt)
            let options = '';
            $.ajax({
                url: `/states/${id}`,
                 method: 'GET',
                 data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        opt.empty();
                                
                                opt.append('<option value="">Select</option>');
                      
                        $.each(response.state, function(index, state) {
                            // console.log(state.name)
                         options+=`<option value="${state.id}">${state.name}</option>`


                        })
                        opt.append(options);

                    },
                    error: function(error){
                        console.log(error);
                    }

        });
    });


    $(document).on('change','#scountry',function(){
            let id=$(this).val();
            // console.log(id);
            let opt=$('#sstate');

            // console.log(opt)
            let options = '';
            $.ajax({
                url: `/states/${id}`,
                 method: 'GET',
                 data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        opt.empty();
                                
                                opt.append('<option value="">Select</option>');
                      
                        $.each(response.state, function(index, state) {
                            // console.log(state.name)
                         options+=`<option value="${state.id}">${state.name}</option>`


                        })
                        opt.append(options);

                    },
                    error: function(error){
                        console.log(error);
                    }

        });
    });

</script>
@endsection
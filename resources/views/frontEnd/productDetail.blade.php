@extends('frontEnd.layout.site-master')

@section('content')

<section id="details">
    
    <div class="contain">
        {{-- @foreach ($prod->productPhotos as $item)
        <img src="{{asset($item->photo_path)}}" alt="">
        @endforeach --}}
                            
        <form id="my-form">
            @csrf
            <input type="text" hidden name="product_id" value="{{$prod->id}}">
            <div class="row flex_row">
                <div class="col1">
                    <div class="in_col">
                        <div id="slick-detail" class="slick-carousel slick-slider">
                         
                            @foreach ($prod->productPhotos as $item)
                            <div class="item">
                                <figure data-href="{{asset($item->photo_path)}}" class="image" data-fancybox="detail"><img src="{{asset($item->photo_path)}}" alt=""></figure>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col2">
                    <div class="content">
                        <h3 class="title">{{$prod->title}}</h3>
                        <div class="brand fw_600">Artikelnummer: 7263</div>
                        @if($prod->quantity > 0 )
                        <div class="stock_status green_text">In stock</div>
                        @else
                        <div class="stock_status text-danger">Out of stock</div>

                        @endif
                        <div class="price">
                            @if($offer)
                                <h5>Offer Active</h5> <br>
                                ${{$offer->offerPrice}} <del>${{$prod->price}}</del>
                            @else
                            ${{$prod->price}}
                            @endif   
                        </div>
                        
                        <h6>Color</h6>
                        {{-- <div class="color_ico ico"><img src="assets/images/color/black.jpg" alt=""></div> --}}

                    <div style="display:flex">
                            @foreach ($prod->productColors as $key=>$color)
                            <div class="color_ico ico" style="position: relative; margin: 5px; border: 4px solid transparent; width: 50px; height: 50px; cursor: pointer;">
                                
                                    <input type="radio" name="selected_color" id={{$key}} 
                                    {{ $key == 0 ? 'checked' : '' }} style="display: none;" 
                                        
                                   value="{{ $color->id }}" class="color-radio" />
                                    <label for="{{$key}}" style="background-color: {{ $color->color }}; width: 100%; height: 100%; display: block;"></label>
                                    {{-- <div  class="color_ico ico" > </div> --}}
                        </div> 
                          
                            @endforeach 
                        </div>


                        <h6>Size</h6>
                        <div style="display:flex">
                            @foreach ($prod->productSize as $ch=>$size)
                            {{-- {{$size->size}} --}}
                            <div class="size_ico ico" style="position: relative; margin: 5px; border: 4px solid transparent; width: 50px; height: 50px; cursor: pointer;">
                                 
                                    <input type="radio" name="selected_size" id="size-{{$ch}}"
                                    {{ $ch == 0 ? 'checked' : '' }}  style="display: none;" 
                                        
                                   value="{{ $size->id }}" class="size-radio" />
                                    <label for="size-{{$ch}}" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; cursor: pointer;">{{$size->size}}</label>
                                    {{-- <div  class="color_ico ico" > </div> --}}
                        </div> 
                          
                            @endforeach 
                        </div>
                      
                     
                        <h6>Quantity</h6>
                        <div class="qty_btn mb-4">
                            <a class="minus"></a>
                            <input type="text" name="qty" value="1" class="qty">
                            <a class="plus"></a>
                        </div>
                        <p>total Qty: <span id="tqty">{{$prod->quantity}} </span></p><h5 class="text-danger

                        "> {{$prod->quantity == 0 ? "Out of Stock":''}}</h5>
                    </div>
                    <div class="btn_blk">
                        <button type="button" id="cart" {{$prod->quantity == 0 ? "disabled":''}} class="site_btn blank stroke w-100">Add to Cart</button>
                        {{-- <a href="checkout.php" type="submit" class="site_btn blank stroke w-100">Buy Now</a> --}}
                        @if($wishing == "false")
                        <button type="button" id="whishlist" data-id="{{$prod->id}}"  class="site_btn blank stroke w-100"><img src="assets/images/icon-heart.svg" alt="">Add to wishlist</button>
                        @else 
                        <button  type="button" id="whishlist" data-id="{{$prod->id}}"  class="site_btn stroke w-100"><img src="assets/images/icon-heart.svg" alt="">Remove From Wishlist</button>
                        @endif 

                        <button id="makeOffer" type="button" {{$prod->quantity == 0 ? "disabled":''}} class="site_btn w-100 pop_btn" data-popup="offer">Make an offer</button>
                        {{-- <button type="button" class="site_btn w-100">Message seller</button> --}}
                    </div>
                </div>
            </div>
            <div class="textual">
                <div class="nav tab_list" role="tablist">
                    <button type="button" class="active" data-bs-toggle="pill" data-bs-target="#tab_Description" role="tab">Description</button>
                    <button type="button" data-bs-toggle="pill" data-bs-target="#tab_Return" role="tab">Reviews</button>
                </div>
                <div class="tab-content">
                    <div id="tab_Description" class="tab-pane fade show active" role="tabpanel">
                        <h4>Description</h4>
                        <p>{{$prod->discription}}</p>
                    </div>

                    <div id="tab_Return" class="tab-pane fade" role="tabpanel">
                        <h4>Reviews</h4>
                        @if($rev->isNotEmpty())
                        <div id="reviews">
                            @foreach($rev as $review)
                            <div class="review-item">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                    <!-- User Name -->
                                    <h5 style="margin: 0;">{{ $review->user->name }}</h5>
                                    
                                    <!-- Rating Stars -->
                                    <div class="star-rating" style="font-size: 20px;">
                                        @php
                                            $rating = $review->rating;
                                        @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="star" style="color: {{ $i <= $rating ? '#ffcc00' : '#d3d3d3' }};">&#9733;</span> <!-- Filled or empty star -->
                                        @endfor
                                    </div>
                                </div>
                            
                                <!-- Review Comment -->
                                <p>{{ $review->comment }}</p>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <h4>No Review Found</h4>
                        @endif

      
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- details -->


<section id="items" class="pt-0">
    <div class="contain">
        <div class="content">
            <div class="text">
                <h3>Similar Products</h3>
                <p>Explore our curated collection of high-performance tracksuits. Place your bid now to own these stylish and comfortable athletic wears.</p>
            </div>
            <a href="?" class="read_more_btn">See all</a>
        </div>
        <div class="row card_row">
            @foreach($similarProducts as $item)

            {{-- <div class="col">
                <div class="product_item mini">
                    <button type="button" class="like_btn"><img src="assets/images/icon-heart.svg" alt="Like Button"></button>
                    <div class="image">
                        <a href="product-detail.php">
                            <img src="assets/images/products/01.jpg" alt="Product Photo">
                        </a>
                    </div>
                    <div class="text">
                        <div class="title"><a href="product-detail.php">Women's Hooded Loungewear Set - L / Khaki</a></div>
                        <div class="btm">
                            <div class="ico_blk">
                                <div class="ico fill round"><img src="https://www.herosolutions.com.pk/metoo/tracksuit/assets/images/users/01.webp" width="150" height="150" alt="User Photo"></div>
                                <div class="name">Jennifer Kem</div>
                            </div>
                            <div class="price">$200</div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col">
                <div class="product_item mini">
                    <button type="button" id="whishlist" data-id="{{$item['id']}}"
                    style="{{ in_array($item->id, $wishlistProductIds) ? 'background-color: orange;' : '' }}"
                    
                    class="like_btn"><img src="{{asset('/front/assets/images/icon-heart.svg')}}" alt="Like Button"></button>
                    <div class="image">
                        {{-- product Detail --}}
                        <a href="#">
                            <img src="{{ asset($item->firstPhoto->photo_path) }}" alt="Product Photo">
                        </a>
                    </div>
                    <div class="text">
                        <div class="title"><a href="{{route('user.productDetail',$item->id)}}">{{$item->title}}</a></div>
                        <div class="btm">
                            @if(!is_null($item->productUserName))
                            {{-- @if(!is_null($item->productUser)) --}}

                            <div class="ico_blk">

                                <div class="ico fill round"><img 
                                    {{-- src="{{ asset($item->productUser->photo) }}" --}}
                            @if(!is_null($item->productUser))

                                    src="{{ $item->productUser->photo ? asset($item->productUser->photo) : asset("noimage.jpg") }}"
                            @else
                                    src="{{asset('noimage.jpg')}}"
                            @endif

                            
                            alt="hii"

                                     width="150" height="150" alt="User Photo"></div>

                                <div class="name">{{ $item->productUserName->name}}</div>
                            </div>
                            @endif

                            {{-- for Empty khata --}}
                            @if(is_null($item->productUserName))
                            {{-- @if(!is_null($item->productUser)) --}}

                            <div class="ico_blk">

                                <div class="ico fill round"><img 
                                    {{-- src="{{ asset($item->productUser->photo) }}" --}}
                            @if(is_null($item->productUser))

                                    src="{{  asset("adminimage.jpg") }}"
                            {{-- @else
                                    src="{{asset('noimage.jpg')}}" --}}
                            @endif
                            
                            
                            alt="hii"

                                     width="150" height="150" alt="User Photo"></div>

                                <div class="name"> Admin item</div>
                            </div>
                            @endif
                            <div class="price">{{$item->price}}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="col">
                <div class="product_item mini">
                    <button type="button" class="like_btn"><img src="assets/images/icon-heart.svg" alt="Like Button"></button>
                    <div class="image">
                        <a href="product-detail.php">
                            <img src="assets/images/products/02.jpg" alt="Product Photo">
                        </a>
                    </div>
                    <div class="text">
                        <div class="title"><a href="product-detail.php">Women's Hooded Loungewear Set - L / Khaki</a></div>
                        <div class="btm">
                            <div class="ico_blk">
                                <div class="ico fill round"><img src="https://www.herosolutions.com.pk/metoo/tracksuit/assets/images/users/02.webp" width="150" height="150" alt="User Photo"></div>
                                <div class="name">Mike Tyson</div>
                            </div>
                            <div class="price">$200</div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col">
                <div class="product_item mini">
                    <button type="button" class="like_btn"><img src="assets/images/icon-heart.svg" alt="Like Button"></button>
                    <div class="image">
                        <a href=">product-detail.php">
                            <img src="assets/images/products/03.jpg" alt="Product Photo">
                        </a>
                    </div>
                    <div class="text">
                        <div class="title"><a href="product-detail.php">Women's Hooded Loungewear Set - L / Khaki</a></div>
                        <div class="btm">
                            <div class="ico_blk">
                                <div class="ico fill round"><img src="https://www.herosolutions.com.pk/metoo/tracksuit/assets/images/users/03.webp" width="150" height="150" alt="User Photo"></div>
                                <div class="name">Monica Kajvral</div>
                            </div>
                            <div class="price">$200</div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col">
                <div class="product_item mini">
                    <button type="button" class="like_btn"><img src="assets/images/icon-heart.svg" alt="Like Button"></button>
                    <div class="image">
                        <a href="product-detail.php">
                            <img src="assets/images/products/04.jpg" alt="Product Photo">
                        </a>
                    </div>
                    <div class="text">
                        <div class="title"><a href="product-detail.php">Women's Hooded Loungewear Set - L / Khaki</a></div>
                        <div class="btm">
                            <div class="ico_blk">
                                <div class="ico fill round"><img src="https://www.herosolutions.com.pk/metoo/tracksuit/assets/images/users/04.webp" width="150" height="150" alt="User Photo"></div>
                                <div class="name">Samira Jones</div>
                            </div>
                            <div class="price">$200</div>
                        </div>
                    </div>
                </div>
            </div>  --}}
            {{-- <div class="col">
                <div class="product_item mini">
                    <button type="button" class="like_btn"><img src="assets/images/icon-heart.svg" alt="Like Button"></button>
                    <div class="image">
                        <a href="product-detail.php">
                            <img src="assets/images/products/05.jpg" alt="Product Photo">
                        </a>
                    </div>
                    <div class="text">
                        <div class="title"><a href="product-detail.php">Women's Hooded Loungewear Set - L / Khaki</a></div>
                        <div class="btm">
                            <div class="ico_blk">
                                <div class="ico fill round"><img src="https://www.herosolutions.com.pk/metoo/tracksuit/assets/images/users/05.webp" width="150" height="150" alt="User Photo"></div>
                                <div class="name">John Wick</div>
                            </div>
                            <div class="price">$200</div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

      <!-- Modal for Not Logged In -->
<div class="modal fade" id="notLoggedInModal" tabindex="-1" aria-labelledby="notLoggedInLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notLoggedInLabel">You Are Not Logged In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Please log in to add items to your wishlist.
            </div>
            <div class="modal-footer">
                <a href="/login" class="btn btn-primary">Log In</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div> 
        </div>
    </div> 
</div>
    
    
    <!-- Toast for Success/Removed Messages -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
        <div id="wishlistToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <span id="toastMessage">Product added to wishlist successfully!</span>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>   
{{-- $prod->productPhotos  --}}

   
</section>

  {{-- =============== --}}

    {{-- POP IS HERE --}}
    <div class="popup offer_popup" data-popup="offer">
        <div class="table_dv">
            <div class="table_cell">
                <div class="_inner">
                    <div class="x_btn"></div>
                    <div class="flex">
                        <div class="colL">
                            <div class="inner">
                                <img src="{{asset(($prod->productPhotos[0]->photo_path))}}" alt="Product Photo">
                            </div>
                        </div>
                        <div class="colR">
                            <div class="content">
                                <h3 class="title">{{$prod->title}}</h3>
                                <div class="brand fw_600">Artikelnummer: 7263</div>
                                <div class="stock_status green_text">In stock</div>
                                <div class="price" id="productPrice">{{$prod->price}}</div>
                                <hr>
                                @if($offer)
                                <h6>Already Your Offer Is Accepted</h6>
                                @else
                                <h6>What offer you will make?</h6>
                                @endif
                                <form id="offerForm">
                                    @csrf
                                <input type="text" class="input" id="offerprice" name="price">
                               <h4 id="warning-big" style="display: none" class="text-danger"></h4>
                                <input type="hidden" name="product_id" value="{{$prod->id}}">
                                <label id="offerprice-error" class="error" for="offerprice"></label>
                                
                                <div class="btn_blk">
                                    
                                    <button {{ $offer ? 'disabled' : '' }} class="site_btn">Make Offer</button>
                                </div>
                            </form>
                            {{-- <span id="productPrice" style="display: none;">50</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- items -->
    



@endsection
@section('script')
<script type="text/javascript">
var myModal = new bootstrap.Modal(document.getElementById('notLoggedInModal'));
    $(document).ready(function(){
        $(document).on('click',"#check",function(){
                console.log('ellow');
                // $('#notLoggedInModal').show();
                $('#notLoggedInModal').modal('show');
                // console.log($(;).modal('show'))

            // myModal.show(); 

            })

        $("#my-form").validate({
        rules: {
                qty: {
                    required: true,
                    number:true
                },
              
            },
            messages: {
                title: {
                    required: "This field is required.",
                    number: "Please enter at a number."
                },
             
                
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent()); // Place the error message after the input element
            },
            highlight: function(element) {
                $(element).addClass('text-danger'); // Add error class to the element
            },
            unhighlight: function(element) {
                $(element).removeClass('text-danger'); // Remove error class from the element
            }
        });
        $('#slick-detail').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true
        });

          // Apply the border to the initially checked radio button
   $('.color-radio:checked').closest('.color_ico').css('border', '4px solid black'); // Set initial border for     the selected color
   
// Handle the change event on radio buttons
    $('.color-radio').on('change', function() {
       
    // Remove the border from all color icons
    $('.color_ico').css('border', '4px solid transparent');

    // Add the border to the selected color icon
    $(this).closest('.color_ico').css('border', '4px solid black');
});





        
        //   // Apply the border to the initially checked radio button
       let b= $('.size-radio:checked').closest('.size_ico').css('border', '4px solid black'); // Set initial border for the selected color
        // console.log(b)
        $('.size-radio').on('change', function() {
            console.log("hi")
        // Remove the border from all size icons
        $('.size_ico').css('border', '4px solid transparent');
        let a=$(this)
            console.log(a)
        // Add the border to the selected size icon
        $(this).closest('.size_ico').css('border', '4px solid black');
    });




// <div style="display:flex">
//                             @foreach ($prod->productSize as $key=>$size)
//                             <div class="size_ico ico" style="position: relative; margin: 5px; border: 4px solid transparent; width: 50px; height: 50px; cursor: pointer;">
                                
//                                     <input type="radio" name="selected_size" id={{$key}} 
//                                     {{ $key == 0 ? 'checked' : '' }} style="display: none;" 
                                        
//                                    value="{{ $size->size }}" class="size-radio" />
//                                     <label for="{{$key}}">{{$size->size}}</label>
//                                     {{-- <div  class="color_ico ico" > </div> --}}
//                         </div> 
                          
//                             @endforeach 
//                         </div>

		
$(document).on('click','#whishlist',function(){ 
            console.log('hi')
			let id = $(this).attr("data-id");
			$.ajax({
            url: '/addWishlist/' +id,
            type: 'get',
            success: function(response) {
				console.log(response);
                // alert(response.success);
				if (response.siginIn) {
                    // Show Not Logged In Modal
                    $('#notLoggedInModal').modal('show');
                } else if (response.status === 'added' || response.status === 'removed') {
                    // Update Toast Message
					// console.log(response.status);
                    const message =
                        response.status === 'added'
                            ? 'Product added to wishlist successfully!'
                            : 'Product removed from wishlist successfully!';
                    $('#toastMessage').text(message);

                    // Show Toast Notification
                    const toast = new bootstrap.Toast(document.getElementById('wishlistToast'));
                    toast.show();

					setTimeout(function () {
        // alert('Reloading Page');
        location.reload(true);
      }, 1000);
                } 



				// location.reload();
                // Optionally: Refresh the product list or redirect 
            },
            error: function(error) {
				console.log(error);
                alert(error.responseJSON.error);
				// location.reload();
            }
        });
    	
		})
$(document).on('click','#cart',function(e){
    e.preventDefault();
    let form=$('#my-form')[0];
    // console.log(form)
//     let form=$(this)[0];

  
    

let formData = new FormData(form);

        $.ajax({
                        url: "{{ route('user.addtocart') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function(response) {
                            // console.log(response.redirect_url);

                            window.location.href = response.redirect_url;
                            // var objData = jQuery.parseJSON(response);
                            // console.log(objData)
                            // window.location.href = "page2.html";
                            
                        },
                        error:function(error){
                             console.log(error.responseJson)
                             $('#notLoggedInModal').modal('show');
                            // let err =error.responseJSON.errors;
                            // console.log(err.photos2)

                        }
                    })

})
   

$(document).on('click','.minus',function(){
    // console.log('hi');
    let va=$('.qty').val()-1;
    if( va== 0 || va < 0){
        $('.qty').val(1);
    }else{
    $('.qty').val(va);
    }
    
})

$(document).on('click','.plus',function(){
    let va = parseInt($('.qty').val(), 10);
    va=va+1;
    let to=$('#tqty').html();
    if(va > to){
    $('.qty').val(to);

    }else{
    $('.qty').val(va);
    }
})


$(document).on('change','.qty',function(){
    let a=$('.qty').val();
    let va = parseInt(a, 10);
    let to=$('#tqty').html();
    if(va > to){
    $('.qty').val(to);

    }else{
    $('.qty').val(va);
    }

    if(va < 0){
    $('.qty').val(1);

    }
})


$(document).on('change','#offerprice',function(){
    // let pr = parseInt($(this).val(), 10); // Convert input value to integer
    // let va = parseInt($('#productPrice').html(), 10); // Convert HTML content to integer

    // // Handle invalid input (NaN)
    // if (isNaN(pr)) {
    //     pr = 0; // Default value if the input is not a valid number
    // }

    // if (isNaN(va)) {
    //     va = 0; // Default value if the actual price is not a valid number
    // }

    // // Logic for showing warnings
    // if(pr > va){
    //     $('#warning-big').fadeIn();
    //     $('#warning-big').html('You have entered a bigger amount than the actual price.');
    // } else if(pr == 0 || pr < 0 ){
    //     $('#warning-big').fadeIn();
    //     $('#warning-big').html('Please enter a valid amount.');
    // } else {
    //     $('#warning-big').fadeOut();
    // }
});
		// productPrice
		$(document).on('click','#wishlist',function(){ 
            $('#notLoggedInModal').modal('show');
	// 		let id = $(this).attr("data-id");
	// 		$.ajax({
    //         url: '/addWishlist/' +id,
    //         type: 'get',
    //         success: function(response) {
	// 			console.log(response);
    //             // alert(response.success);
	// 			if (response.siginIn) {
    //                 // Show Not Logged In Modal
    //                 $('#notLoggedInModal').modal('show');
    //             } else if (response.status === 'added' || response.status === 'removed') {
    //                 // Update Toast Message
	// 				// console.log(response.status);
    //                 const message =
    //                     response.status === 'added'
    //                         ? 'Product added to wishlist successfully!'
    //                         : 'Product removed from wishlist successfully!';
    //                 $('#toastMessage').text(message);

    //                 // Show Toast Notification
    //                 const toast = new bootstrap.Toast(document.getElementById('wishlistToast'));
    //                 toast.show();

	// 				setTimeout(function () {
    //     // alert('Reloading Page');
    //     location.reload(true);
    //   }, 1000);
    //             } 



	// 			// location.reload();
    //             // Optionally: Refresh the product list or redirect 
    //         },
    //         error: function(error) {
	// 			console.log(error);
    //             alert(error.responseJSON.error);
	// 			// location.reload();
    //         }
        });
    	
		// })



        $(document).on('click', '#makeOffer', function() {
         $('.popup.offer_popup').fadeIn(); // Show popup
});


// Hide popup when "x" button or outside is clicked
$(document).on('click', '.popup .x_btn, .popup', function(e) {
    if ($(e.target).closest('._inner').length === 0 || $(e.target).hasClass('x_btn')) {
        $('.popup.offer_popup').fadeOut(); // Hide popup
    }
});

// <div class="content">
// 							<h3 class="title">{{$prod->title}}</h3>
// 							<div class="brand fw_600">Artikelnummer: 7263</div>
// 							<div class="stock_status green_text">In stock</div>
// 							<div class="price" id="productPrice">${{$prod->price}}</div>
// 							<hr>
// 							<h6>What offer you will make?</h6>
//                             <form id="offerForm">
// 							<input type="text" class="input" required name="price">
//                             <input type="hidder" name="product_id" value="{{$prod->price}}">
// 							<div class="btn_blk">
// 								<button type="submit" class="site_btn">Make Offer</button>
// 							</div>
//                         </form>


//validation 
    // Fetch product price dynamically
    let va = parseInt($('#productPrice').html(), 10); // Convert the price to an integer
    console.log(va);

    // Initialize validation
    $("#offerForm").validate({
        rules: {
            offerprice: {
                required: true,
                range: [1, va - 1], // Set dynamic range
            },
        },
        messages: {
            offerprice: {
                required: "This field is required.",
                range: `Please enter a value between 1 and ${va - 1}.`, // Dynamic error message
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent()); // Place error after parent element
        },
        highlight: function (element) {
            $(element).addClass('text-danger'); // Add error class
        },
        unhighlight: function (element) {
            $(element).removeClass('text-danger'); // Remove error class
        },
    });

    // Handle real-time validation for dynamic message display
    $('#offerprice').on('input', function () {
        const offerPrice = parseInt($(this).val(), 10);
        if (offerPrice >= va) {
            $('#warning-big').fadeIn().text('You have entered a value larger than the product price.');
        } else if (offerPrice === 0) {
            $('#warning-big').fadeIn().text('Please enter a valid amount.');
        } else {
            $('#warning-big').fadeOut();
        }
    });
});


$(document).on('submit','#offerForm',function(e){
    e.preventDefault();
   
 let form=$(this)[0];
//   yahn py lgana pry ga. 
    

let formData = new FormData(form);

$.ajax({
                url: "{{ route('user.makeOffer') }}",
                type: 'POST',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                success: function(response) {
                 console.log(response); 
                  if(response.status === 'added'){

                    const message =
                        response.status === 'added'
                            ? 'Product added to wishlist successfully!'
                            : 'Product removed from wishlist successfully!';
                    $('#toastMessage').text(message);

                    // Show Toast Notification
                    const toast = new bootstrap.Toast(document.getElementById('wishlistToast'));
                    toast.show();
                     
                    $('.popup.offer_popup').fadeOut(); 

                  }

                    // window.location.href = response.redirect_url;
                    // var objData = jQuery.parseJSON(response);
                    // console.log(objData)
                    // window.location.href = "page2.html";
                    
                },
                error:function(error){
                     console.log(error.responseJson)
                    //  $('#notLoggedInModal').modal('show'); 
                    // let err =error.responseJSON.errors;
                    // console.log(err.photos2)

                }
            })


           
	})


    








    </script>
    
@endsection
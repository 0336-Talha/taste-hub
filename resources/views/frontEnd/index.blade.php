@extends('frontEnd.layout.site-master')

@section('content')
@if(session('success'))
    <div id="success-message" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px;">
        {{ session('success') }}
    </div>
@endif

	{{-- <section id="banner" style="background-image: url('/asset('/front/')assets/images/banner_background.jpg');"> --}}
		
		<section id="banner" style="background-image:url('{{ isset($data['meta_data']['image1']) ? $data['meta_data']['image1'] : '' }}')">

		<div class="contain">
			<div class="flex_blk">
				<div class="content text-center">
					{{-- <h1>Elevate Your Tracksuit Company with Exclusive Bidding!</h1> --}}
					{{-- {{$data['meta_data']['editor1']}} --}}
					{!! htmlspecialchars_decode($data['meta_data']['editor1']) !!}
					{!! htmlspecialchars_decode($data['meta_data']['editor2']) !!}

					{{-- <p>Discover, Bid, and Win Premium Tracksuits at Unbeatable Prices.</p> --}}
					<div class="btn_blk justify-content-center">
						<a href="/catalog.php" class="site_btn simple px">{{$data['meta_data']['btn1txt']}}</a>
						<a href="#" class="site_btn simple blank stroke px">{{$data['meta_data']['btn2txt']}}</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- banner -->


	<!-- <section id="points">
		<div class="contain">
			<div class="wrapper">
				<div class="column">
					<div class="inner">
						<div class="icon"><img src="assets/images/package_vector.png" alt="Package"></div>
						<div class="text">
							<div class="h5">Millions of unique items</div>
							<p>Enter your bid amount and confirm your bid. Keep an eye on the bidding activity to stay informed about competing offers.</p>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="inner">
						<div class="icon"><img src="assets/images/curation_vector.png" alt="Curation"></div>
						<div class="text">
							<div class="h5">Curated by experts</div>
							<p>Enter your bid amount and confirm your bid. Keep an eye on the bidding activity to stay informed about competing offers.</p>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="inner">
						<div class="icon"><img src="assets/images/auction_vector.png" alt="Auction"></div>
						<div class="text">
							<div class="h5">Bid with ease</div>
							<p>Enter your bid amount and confirm your bid. Keep an eye on the bidding activity to stay informed about competing offers.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!-- points -->


	<section id="feature">
		<div class="contain">
			<div class="content">
				<div class="text">
					<h3>{{$data['meta_data']['heading1']}}</h3>
					{!! htmlspecialchars_decode($data['meta_data']['editor3']) !!}
					
				</div>
				<a href="?" class="read_more_btn">See all</a>
			
			</div>
			<div class="row card_row">
				@foreach ($feature as $item)
				{{-- @if(Auth::user())
					hello
				@endif --}}
				
				<div class="col">
					<div class="product_item">

						<button type="button" id="whishlist"
						 {{-- style="background-color:orange"  --}}
						 
						style="{{ in_array($item->id, $wishlistProductIds) ? 'background-color: orange;' : '' }}"

						 
						 

						 
						  data-id="{{$item['id']}}" active="true" class="like_btn active"><img src="{{asset('/front/assets/images/icon-heart.svg')}}"  alt="Like Button"></button>
					
						<div class="image">
							<a href="{{route('user.productDetail',$item->id)}}">
								<img src="{{ asset($item->firstPhoto->photo_path) }}" alt="Product Photo">
							</a>
						</div>
						<div class="text">
							<div class="title"><a href="{{route('user.productDetail',$item->id)}}">{{$item->title}}</a></div>
							<div class="start_price"><small>Starting</small> {{$item->price}}</div>
						</div>
					</div>
				</div>
				@endforeach


			</div>
		</div>
	</section>
	<!-- feature -->

	{{-- @foreach ($brand as $item)
				{{-- {{$item->name}}	 --}}
				{{-- <div class="item">
				
					<div class="icon"><a href="?"><img src="{{asset($item->image)}}" alt="Brand Logo">{{$item->name}}</a></div>
				</div> --}}
				{{-- @endforeach --}} 

	{{-- <section id="brands" class="pt-0">
		<div class="contain">
			<div class="content">
				
				<h3>{{$data['meta_data']['heading2']}}</h3>
				{!! htmlspecialchars_decode($data['meta_data']['editor4']) !!}

			</div>
			<div id="slick-brands" class="slick-carousel slick-slider">
			 --}}
				{{-- <div class="item">
				
					<div class="icon"><a href="?"><img src="assets/images/brand_01.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="assets/images/brand_02.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="assets/images/brand_03.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="assets/images/brand_04.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="assets/images/brand_05.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="assets/images/brand_06.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="assets/images/brand_07.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="assets/images/brand_08.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="assets/images/brand_03.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="assets/images/brand_04.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="assets/images/brand_05.png" alt="Brand Logo"></a></div>
				</div> --}}
			{{-- </div>
		</div>
	</section> --}}
	<!-- brands -->

	<section id="brands" class="pt-0">
		<div class="contain">
			<div class="content">
				<h3>Shop by brand</h3> 
				<p>Enter your bid amount and confirm your bid. Keep an eye on the bidding activity to stay informed about competing offers.</p>
			</div>
			<div id="slick-brands" class="slick-carousel slick-slider">
				@foreach ($brand as $brand)
				{{$brand->name}} 
				{{-- problem --}}
				<div class="item">
					<div class="icon"><a href="?"><img src="{{asset($brand->image)}}" alt="Brand Logo"></a></div>
				</div>
				@endforeach
				
				<div class="item">
					<div class="icon"><a href="?"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/brand_02.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/brand_03.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/brand_04.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/brand_05.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/brand_06.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/brand_07.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/brand_08.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/brand_03.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/brand_04.png" alt="Brand Logo"></a></div>
				</div>
				<div class="item">
					<div class="icon"><a href="?"><img src="https://www.herosolutions.com.pk/breera/tracksuit-f/assets/images/brand_05.png" alt="Brand Logo"></a></div>
				</div>
			</div>
		</div>
	</section>
	<!-- brands -->


	<section id="works">
		<div class="contain">
			<div class="content">
				<h3>{{$data['meta_data']['heading3']}}</h3>
				{!! htmlspecialchars_decode($data['meta_data']['editor5']) !!}
			</div>
			<div class="wrapper">
				<div class="column">
					<div class="inner">
						<div class="icon"><img src="{{$data['meta_data']['image2']}}" alt="Browse"></div>
						<div class="text">
							<div class="h5">{{$data['meta_data']['heading4']}}</div>
							{!! htmlspecialchars_decode($data['meta_data']['editor6']) !!}

						</div>
					</div>
				</div>
				<div class="column">
					<div class="inner">
						<div class="icon"><img src="{{$data['meta_data']['image3']}}" alt="Bid"></div>
						<div class="text">
							<div class="h5">{{$data['meta_data']['heading5']}}</div>
							{!! htmlspecialchars_decode($data['meta_data']['editor7']) !!}

						</div>
					</div>
				</div>
				<div class="column">
					<div class="inner">
						<div class="icon"><img src="{{$data['meta_data']['image4']}}" alt="Winner"></div>
						<div class="text">
							<div class="h5">{{$data['meta_data']['heading6']}}</div>
							{!! htmlspecialchars_decode($data['meta_data']['editor8']) !!}

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- works -->


	<section id="items">
		<div class="contain">
			<div class="content">
				<div class="text">
					<h3>{{$data['meta_data']['heading7']}}</h3>
					{!! htmlspecialchars_decode($data['meta_data']['editor9']) !!}

				</div>
				<a href="?" class="read_more_btn">See all</a>
			</div>
			<div class="row card_row">
				
					@foreach ($userProducts as $item)
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
				
	
			</div>
		</div>
	</section>
	<!-- items -->


	<!-- <section id="trust" class="pt-0">
		<div class="contain">
			<div class="wrapper">
				<div class="content">
					<h3>Trust and Security</h3>
					<p>We prioritize the security and trust of our users. Your peace of mind is essential to us, and we want to ensure a safe and enjoyable bidding experience. Here's how we guarantee your trust and security:</p>
					<ul class="list">
						<li>
							<img src="<?= asset('/front/') ?>assets/images/check_circle.svg" width="60" height="60" alt="Check Circle">
							<div class="inr">
								<h5>Secure Transactions</h5>
								<p>Your transactions are encrypted and secure, ensuring the confidentiality and integrity of your financial information.</p>
							</div>
						</li>
						<li>
							<img src="<?= asset('/front/') ?>assets/images/check_circle.svg" width="60" height="60" alt="Check Circle">
							<div class="inr">
								<h5>Trusted Payment Options</h5>
								<p>Choose from a variety of trusted and secure payment options, including major credit cards and PayPal.</p>
							</div>
						</li>
						<li>
							<img src="<?= asset('/front/') ?>assets/images/check_circle.svg" width="60" height="60" alt="Check Circle">
							<div class="inr">
								<h5>Data Protection</h5>
								<p>We are committed to safeguarding your data. Our robust data protection measures ensure the privacy and confidentiality of your personal information.</p>
							</div>
						</li>
					</ul>
					<div class="btn_blk mt-5">
						<a href="?" class="site_btn">Start Bidding Now!</a>
						<a href="?" class="site_btn simple stroke px">Read More</a>
					</div>
				</div>
				<div class="image">
					<img src="<?= asset('/front/') ?>assets/images/secure_transaction.png" width="800" height="800" alt="Secure Transaction">
				</div>
			</div>
		</div>
	</section> -->
	<!-- trust -->


	<section id="posts">
		<div class="contain">
			<div class="content">
				<div class="text">
					<h3 class="mb-0">{{$data['meta_data']['heading8']}}</h3>
				</div>
				<a href="?" class="read_more_btn">See all</a>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="blog_blk">
						<div class="tag">Nike</div>
						<div class="image">
							<a href="<?= asset('/front/') ?>blog-detail.php">
								<img src="<?= asset('/front/') ?>assets/images/blog_01.jpg" width="600" height="500" alt="Blog Post">
							</a>
						</div>
						<div class="text">
							<h4><a href="<?= asset('/front/') ?>blog-detail.php">Congue magna tempor and ipsum Martex sapien.....</a></h4>
							<div class="time">1 Month Ago </div>
							<p>lit. Phasellus aliquet nibh id iaculis pharetra. Maecenas eleifend sed ex. Donec quis magna sed felis elementum blandit nec quis sem. Maecen.</p>
							<a href="<?= asset('/front/') ?>blog-detail.php" class="view_post">View Post</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="blog_blk">
						<div class="tag">Adidas</div>
						<div class="image">
							<a href="<?= asset('/front/') ?>blog-detail.php">
								<img src="<?= asset('/front/') ?>assets/images/blog_02.jpg" width="600" height="500" alt="Blog Post">
							</a>
						</div>
						<div class="text">
							<h4><a href="<?= asset('/front/') ?>blog-detail.php">Congue magna tempor and ipsum Martex sapien.....</a></h4>
							<div class="time">1 Month Ago </div>
							<p>lit. Phasellus aliquet nibh id iaculis pharetra. Maecenas eleifend sed ex. Donec quis magna sed felis elementum blandit nec quis sem. Maecen.</p>
							<a href="<?= asset('/front/') ?>blog-detail.php" class="view_post">View Post</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="blog_blk">
						<div class="tag">Reebok</div>
						<div class="image">
							<a href="<?= asset('/front/') ?>blog-detail.php">
								<img src="<?= asset('/front/') ?>assets/images/blog_03.jpg" width="600" height="500" alt="Blog Post">
							</a>
						</div>
						<div class="text">
							<h4><a href="<?= asset('/front/') ?>blog-detail.php">Congue magna tempor and ipsum Martex sapien.....</a></h4>
							<div class="time">1 Month Ago </div>
							<p>lit. Phasellus aliquet nibh id iaculis pharetra. Maecenas eleifend sed ex. Donec quis magna sed felis elementum blandit nec quis sem. Maecen.</p>
							<a href="<?= asset('/front/') ?>blog-detail.php" class="view_post">View Post</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- posts -->


	<section id="folio">
		<div class="contain">
			<div class="content">
				<h3>{{$data['meta_data']['heading9']}}</h3>
				{!! htmlspecialchars_decode($data['meta_data']['editor10']) !!}
				
			</div>
			<div id="slick-folio" class="slick-carousel slick-slider">
				<div class="item">
					<div class="folio_blk">
						<div class="text">
							<div class="comma"><img src="<?= asset('/front/') ?>assets/images/comma.svg" width="100" height="100" alt="Comma Icon"></div>
							<p>“I've never experienced such an exciting way to get my hands on premium tracksuits! The bidding process was seamless, and the quality of the tracksuit I won exceeded my expectations. Definitely my go-to for athletic wear now!”</p>
						</div>
						<div class="image">
							<img src="<?= asset('/front/') ?>assets/images/folio_01.jpg" width="800" height="600" alt="Folio Photo">
							<div class="btm">
								<div class="name">Albert Flores</div>
								<div class="desg">Product Manager at Jomanar</div>
							</div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="folio_blk">
						<div class="text">
							<div class="comma"><img src="<?= asset('/front/') ?>assets/images/comma.svg" width="100" height="100" alt="Comma Icon"></div>
							<p>“I've never experienced such an exciting way to get my hands on premium tracksuits! The bidding process was seamless, and the quality of the tracksuit I won exceeded my expectations. Definitely my go-to for athletic wear now!”</p>
						</div>
						<div class="image">
							<img src="<?= asset('/front/') ?>assets/images/folio_02.jpg" width="800" height="600" alt="Folio Photo">
							<div class="btm">
								<div class="name">Jennifer Kem</div>
								<div class="desg">Product Manager at Jomanar</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- folio -->
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
	<?php //require_once 'includes/footer.php'; ?>
@endsection

@section('script')
<script>
	    // Automatically hide the message after 5 seconds (5000 ms)
		setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 5000);
	$(document).ready(function(){
		
		
		$(document).on('click','#whishlist',function(){ 
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

	})

	
</script>
@endsection
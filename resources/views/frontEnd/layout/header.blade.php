<header>
	<div class="contain">
		<div class="logo">
			<a href="index.php">
				<img src="{{asset('/front/assets/images/logo.svg')}}" width="200" height="100" alt="Website Logo">
			</a>
		</div>
		<button type="button" class="toggle" aria-label="Toggle Button"><span></span></button>
		<div class="head_strip"> 
			<form action="{{route('filter')}}" method="get" id="query_form">
			
				<input type="search" name="search" id="search_product" class="input" placeholder="Search....">
				<button type="submit"><img src="{{ asset('/front/assets/images/icon-search.svg')}}" width="60" height="60" alt="Search Icon"></button>
			</form>
			@if(!Auth::guard('web')->user())
			<div class="btn_blk">
				<a href="/login" class="site_btn blank stroke logon_btn"> Sign in</a>
				<button type="button" class="buy_sell_btn">Buy/Sell</button>
			</div>
			@else
			<a href="/account" class="site_btn blank stroke logon_btn">Hello! {{Auth::user()->name}}</a>

			@endif
			
			 <div id="lang" class="dropdown">
				{{-- <p>{{Auth::user()->name}}</p> --}}
				{{-- <a href="/login" class="site_btn blank stroke logon_btn"> {{Auth::user()->name}} </a> --}}

				{{-- <button type="button"><img src="{{asset('/front/assets/images/flag-usa.svg')}}" width="100" height="100" alt="USA FLAG"></button> --}}
			</div> 
			<ul id="icon_list">
				
					@if(!Auth::guard('web')->user())
					<li>
					<a href="/login"><img src="{{asset('/front/assets/images/icon-user.svg')}}" width="60" height="60" alt="User Icon"></a>
					
				</li>
					@else
					
					<li class="dropdown">
						<button type="button" class="dropdown-toggle" data-bs-toggle="dropdown"><img src="{{asset('front/assets/images/icon-user.svg')}}" width="60" height="60" alt="User Icon">
						    @if($notifica > 0)
        <span style="position: absolute; top: 5px; left: 18px; width: 12px; height: 12px; background-color: red; border-radius: 50%; border: 2px solid white;"></span>
    @endif
						</button>
						<ul class="account_dropdown dropdown-menu">
							<li><a href="/account">Account</a></li>
							<li><a href="/notifications">Notifications
								@if($notifica > 0)
								<span style="color: red; background-color: yellow; padding: 2px 6px; border-radius: 50%; font-weight: bold;">
									{{ $notifica }}
								</span>
							@endif
							</a></li> 
							<li><a href="/orders.php">Orders</a></li>
							<li><a href="/wishlist.php">Wishlist</a></li>
							<li><a href="/addresses.php">Addresses</a></li>
							{{-- <li><a href="/compare.php">Compare</a></li> --}}
							<li><a href="/my-products.php">My Products</a></li>
							<li><a href="/user/logout">Sign out</a></li>
						</ul>
					</li>
						
					@endif
				
				<li>
					<a href="/wishlist" type="button"><img src="{{asset('front/assets/images/icon-heart.svg')}}" width="60" height="60" alt="Heart Icon"></a>
				</li>
				<li>
					<a href="/cart" type="button"><img src="{{asset('front/assets/images/icon-cart.svg')}}" width="60" height="60" alt="Cart Icon"></a>
				</li>
			</ul>
		</div>
	</div>
	<nav>
		<div class="contain">
			<div id="nav">
				<ul>
					@foreach($categories as $cate)
					<li class="<?php //if ($page == "mens") {
									//echo 'active';
								//} ?> drop">
						<a href="javascript:void(0)">{{$cate->name}}</a>
						<div id="mega__menu__list">
							<ul>
								
								<li>
									<a href="<?= asset('/front/')?>catalog.php" class="h6">Categories</a>
									<ul>
										@foreach($cate->subCategories as $subCategory)
										<li><a href="filter?category={{$subCategory->sub_id}}">{{ $subCategory->name }}</a></li> 
									@endforeach

										{{-- <li><a href="<?= asset('/front/')?>catalog.php">COATS & JACKETS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">COATS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">BOMBER JACKETS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">DENIM JACKETS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">DOWN JACKETS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">LEATHER JACKETS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SPORTS & WINDBREAKERS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SUITS & BLAZERS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">VESTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">T-SHIRTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SWEATSHIRTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">HOODIES</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SHIRTS</a></li> --}}
									</ul>
									<ul>
										{{-- <li><a href="<?= asset('/front/')?>catalog.php">KNIT SWEATERS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">CARDIGANS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">POLOS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">TOPS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">JEANS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">PANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">CASUAL & CARGO PANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SWEATPANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">TRACK PANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SHORTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">ACTIVE & UNDERWEAR</a></li> --}}
									</ul>
								</li>
								<li>
									<a href="<?= asset('/front/')?>catalog.php" class="h6">Brands</a>
									<ul>
										{{-- @foreach($cate->subCategories as $subCategory)
										@foreach($subCategory->products->unique('brand_id')  as $product)
											<li>{{ $product->brand->name }}</li>
										@endforeach
									@endforeach --}}
									@forEach($cate->branding as $brand)
									<li><a href="/filter?brand={{$brand->id}}">{{ $brand->name }}</a></li>

									@endforeach
										{{-- <li><a href="<?= asset('/front/')?>catalog.php">1017 ALYX 9SM</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">A-COLD-WALL*</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">ALEXANDER McQUEEN</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">AMBUSH</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">AMIRI</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">BALENCIAGA</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">BALMAIN</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">DOUBLET</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">EGON LAB</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">GIVENCHY</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">HERON PRESTON</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">JACQUEMUS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">JUUN.J</a></li> --}}
									</ul>
									<ul>
										<li><a href="<?= asset('/front/')?>catalog.php">KENZO</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">LOEWE</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">MAISON MARGIELA</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">MARCELO BURLON</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">MARNI</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">MASTERMIND JAPAN</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">MASTERMIND WORLD</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">OFF-WHITE</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">PALM ANGELS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">REPRESENT</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">RICK OWENS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">DRKSHDW</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SACAI</a></li>
									</ul>
									<ul>
										<li><a href="<?= asset('/front/')?>catalog.php">WE11DONE</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">WOOYOUNGMI</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">Y-3</a></li>
									</ul>
								</li>
								<li>
									<a href="<?= asset('/front/')?>catalog.php" class="h6">Latest Product</a>
									@foreach($cate->subCategories as $cato)
									@foreach($cato->products as $product)
									<div class="nav_product">
										<div class="image">
											<a href="/productDetail/{{$product->id}}">
												<img src="{{asset($product->firstPhoto->photo_path)}}" alt="">
											</a>
										</div>
										<div class="text">
											<div class="brand">{{$product->brand->name}}</div>
											<div class="title"><a href="/productDetail/{{$product->id}}">{{$product->title}}</a></div>
											<div class="price">${{$product->price}}</div>
										</div>
									</div>
									@endforeach
									@endforeach
								
									
								
								</li>
							</ul>
						</div>
					</li>

					@endforeach
					{{-- <li class="<?php //if ($page == "womans") {
									//echo 'active';
								//} ?> drop">
						<a href="javascript:void(0)">Womans</a>
						<div id="mega__menu__list">
							<ul>
								<li>
									<a href="<?= asset('/front/')?>catalog.php" class="h6">Categories</a>
									<ul>
										<li><a href="<?= asset('/front/')?>catalog.php">KNIT SWEATERS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">CARDIGANS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">POLOS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">TOPS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">JEANS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">PANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">CASUAL & CARGO PANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SWEATPANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">TRACK PANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SHORTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">ACTIVE & UNDERWEAR</a></li>
									</ul>
								</li>
								<li>
									<a href="<?= asset('/front/')?>catalog.php" class="h6">Brands</a>
									<ul>
										<li><a href="<?= asset('/front/')?>catalog.php">KENZO</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">LOEWE</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">MAISON MARGIELA</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">MARCELO BURLON</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">MARNI</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">MASTERMIND JAPAN</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">MASTERMIND WORLD</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">OFF-WHITE</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">PALM ANGELS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">REPRESENT</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">RICK OWENS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">DRKSHDW</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SACAI</a></li>
									</ul>
									<ul>
										<li><a href="<?= asset('/front/')?>catalog.php">1017 ALYX 9SM</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">A-COLD-WALL*</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">ALEXANDER McQUEEN</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">AMBUSH</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">AMIRI</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">BALENCIAGA</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">BALMAIN</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">DOUBLET</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">EGON LAB</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">GIVENCHY</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">HERON PRESTON</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">JACQUEMUS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">JUUN.J</a></li>
									</ul>
									<ul>
										<li><a href="<?= asset('/front/')?>catalog.php">BALMAIN</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">DOUBLET</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">EGON LAB</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">GIVENCHY</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">HERON PRESTON</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">WE11DONE</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">WOOYOUNGMI</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">Y-3</a></li>
									</ul>
								</li>
								<li>
									<a href="<?= asset('/front/')?>catalog.php" class="h6">Latest Product</a>
									<div class="nav_product">
										<div class="image">
											<a href="<?= asset('/front/')?>catalog.php">
												<img src="<?= asset('/front/')?>assets/images/products/05.jpg" alt="">
											</a>
										</div>
										<div class="text">
											<div class="brand">OFF-WHITE</div>
											<div class="title"><a href="<?= asset('/front/')?>catalog.php">Moon Varsity Leather Jacket in Black</a></div>
											<div class="price">$1,216</div>
										</div>
									</div>
									<div class="nav_product">
										<div class="image">
											<a href="<?= asset('/front/')?>catalog.php">
												<img src="<?= asset('/front/')?>assets/images/products/06.jpg" alt="">
											</a>
										</div>
										<div class="text">
											<div class="brand">MARNI</div>
											<div class="title"><a href="<?= asset('/front/')?>catalog.php">Mega Marni Bowling Shirt in Lily White</a></div>
											<div class="price">$103</div>
										</div>
									</div>
									<div class="nav_product">
										<div class="image">
											<a href="<?= asset('/front/')?>catalog.php">
												<img src="<?= asset('/front/')?>assets/images/products/07.jpg" alt="">
											</a>
										</div>
										<div class="text">
											<div class="brand">MAISON MARGIELA</div>
											<div class="title"><a href="<?= asset('/front/')?>catalog.php">Deconstruction Bomber Jacket in Beige</a></div>
											<div class="price">$657</div>
										</div>
									</div>
									<div class="nav_product">
										<div class="image">
											<a href="<?= asset('/front/')?>catalog.php">
												<img src="<?= asset('/front/')?>assets/images/products/08.jpg" alt="">
											</a>
										</div>
										<div class="text">
											<div class="brand">BALENCIAGA</div>
											<div class="title"><a href="<?= asset('/front/')?>catalog.php">Bootcut Pants in Blue Light Ring</a></div>
											<div class="price">$323</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</li> --}}
					{{-- <li class="<?php //if ($page == "kids") {
								//	echo 'active';
								//} ?> drop">
						<a href="javascript:void(0)">Kids</a>
						<div id="mega__menu__list">
							<ul>
								<li>
									<a href="<?= asset('/front/')?>catalog.php" class="h6">Categories</a>
									<ul>
										<li><a href="<?= asset('/front/')?>catalog.php">KNIT SWEATERS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">CARDIGANS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">POLOS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">TOPS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">JEANS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">PANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">CASUAL & CARGO PANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SWEATPANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">TRACK PANTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SHORTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">ACTIVE & UNDERWEAR</a></li>
									</ul>
									<ul>
										<li><a href="<?= asset('/front/')?>catalog.php">T-SHIRTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SWEATSHIRTS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">HOODIES</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">SHIRTS</a></li>
									</ul>
								</li>
								<li>
									<a href="<?= asset('/front/')?>catalog.php" class="h6">Brands</a>
									<ul>
										<li><a href="<?= asset('/front/')?>catalog.php">1017 ALYX 9SM</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">A-COLD-WALL*</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">ALEXANDER McQUEEN</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">AMBUSH</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">AMIRI</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">BALENCIAGA</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">BALMAIN</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">DOUBLET</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">EGON LAB</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">GIVENCHY</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">HERON PRESTON</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">JACQUEMUS</a></li>
										<li><a href="<?= asset('/front/')?>catalog.php">JUUN.J</a></li>
									</ul>
								</li>
								<li>
									<a href="<?= asset('/front/')?>catalog.php" class="h6">Latest Product</a>
									<div class="nav_product">
										<div class="image">
											<a href="<?= asset('/front/')?>catalog.php">
												<img src="<?= asset('/front/')?>assets/images/products/09.jpg" alt="">
											</a>
										</div>
										<div class="text">
											<div class="brand">OFF-WHITE</div>
											<div class="title"><a href="<?= asset('/front/')?>catalog.php">Moon Varsity Leather Jacket in Black</a></div>
											<div class="price">$1,216</div>
										</div>
									</div>
									<div class="nav_product">
										<div class="image">
											<a href="<?= asset('/front/')?>catalog.php">
												<img src="<?= asset('/front/')?>assets/images/products/10.jpg" alt="">
											</a>
										</div>
										<div class="text">
											<div class="brand">MARNI</div>
											<div class="title"><a href="<?= asset('/front/')?>catalog.php">Mega Marni Bowling Shirt in Lily White</a></div>
											<div class="price">$103</div>
										</div>
									</div>
									<div class="nav_product">
										<div class="image">
											<a href="<?= asset('/front/')?>catalog.php">
												<img src="<?= asset('/front/')?>assets/images/products/11.jpg" alt="">
											</a>
										</div>
										<div class="text">
											<div class="brand">MAISON MARGIELA</div>
											<div class="title"><a href="<?= asset('/front/')?>catalog.php">Deconstruction Bomber Jacket in Beige</a></div>
											<div class="price">$657</div>
										</div>
									</div>
									<div class="nav_product">
										<div class="image">
											<a href="<?= asset('/front/')?>catalog.php">
												<img src="<?= asset('/front/')?>assets/images/products/12.jpg" alt="">
											</a>
										</div>
										<div class="text">
											<div class="brand">BALENCIAGA</div>
											<div class="title"><a href="<?= asset('/front/')?>catalog.php">Bootcut Pants in Blue Light Ring</a></div>
											<div class="price">$323</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</li> --}}
					{{-- <li class="<?php //if ($page == "vintage") {
						//echo 'active';
					//} ?>"> --}}
			{{-- <a href="<?= asset('/front/')?>trainee.php">Trainers</a> --}}
		</li>


					{{-- <li class="<?php //if ($page == "vintage") {
									//echo 'active';
								//} ?>">
						<a href="<?= asset('/front/')?>vintage.php">Vintage</a>
					</li>
					<li class="<?php //if ($page == "accessories") {
								//	echo 'active';
								//} ?>">
						<a href="<?= asset('/front/')?>accessories.php">Accessories</a>
					</li> --}}
				</ul>
			</div>
		</div>
	</nav>
</header>

<!-- header -->
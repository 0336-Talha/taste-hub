@extends('frontEnd.layout.site-master')

@section('content')
hi from whishlist
	<section id="wishlist">
		<div class="contain sm">
			<h3 class="mb-4">Wishlist</h3>
			<div class="wishlist_table">
				<table>
					<thead>
						<tr>
							<th></th>
							<th>Product</th>
							<th>Price</th>
							<th>Stock</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
                        @foreach($wish as $wishlist)
						<tr>
                            {{-- {{$wishlist->first_photo->photo_path}} --}}
							<td><button type="button" class="x_btn"></button></td>
							<td>
								<div class="ico_blk">
									<div class="ico fill round"><a href="product-detail.php"><img src="{{ asset($wishlist->product->firstPhoto->photo_path) }}" width="200" height="200" alt=""></a></div>
									<div class="name"><a href="product-detail.php">{{$wishlist->product->title}}</a></div>
								</div>
							</td>
							<td>
								<div class="price"><del>$40.00</del>${{$wishlist->product->price}}.00</div>
							</td>
							<td>
                                @if($wishlist->product->quantity == 0)
                                <div class="stock out">Out of Stock</div>
                                @else
								<div class="stock">In Stock </div>
                                @endif
							</td>
							<td><a href="{{$wishlist->product->quantity == 0 ? '#' :'shopping-cart.php' }}" {{$wishlist->product->quantity == 0 ? 'disabled' :'' }}  class="site_btn sm">Add to Cart</a></td>
						</tr>
	
						
					@endforeach
						
						
						
					</tbody>
				</table>
			</div>
			<div class="pagination">
				<ul>
					<li><button type="button" class="prev"></button></li>
					<li class="active"><a href="?">1</a></li>
					<li><a href="?">2</a></li>
					<li><a href="?">3</a></li>
					<li><a href="?">...</a></li>
					<li><a href="?">50</a></li>
					<li><button type="button" class="next"></button></li>
				</ul>
			</div>
		</div>
	</section>
	<!-- wishlist -->



@endsection
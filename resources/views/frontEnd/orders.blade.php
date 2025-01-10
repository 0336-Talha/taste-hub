@extends('frontEnd.layout.site-master')

@section('content')
	<section id="orders">
		<div class="contain sm">
			<h3 class="mb-4">Customer Orders</h3>
			
			<div class="orders_table">
				<table>
					<thead>
						<tr>
							<th>Profile photo</th>
							<th>products</th>
							<th>Quantity</th>
							<th>Date</th>
							
							
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@if($orders->isNotEmpty())
                        @foreach($orders as $itm)
                        {{-- @foreach($item->items as $itm) --}}
                        {{-- @if($itm->product->is_admin == Null) --}}
                        {{-- {{$item['first_photo']['photo_path']}}
                         --}}
                         {{-- {{ $item['first_photo']['photo_path']}} --}}
						<tr>
							<td>
								<div class="ico_blk">
									<div class="ico fill round"><a href="product-detail.php"><img src="{{$itm->orderMaker->photo}}" width="200" height="200" alt=""></a></div>
									<div class="txt">
										{{$itm->orderMaker->accountUser->name}}
										<div class="name"><a href="product-detail.php"></a></div>
										<div class="btn_blk mt-2"><a href="/orderInfo/{{$itm->id}}" class="read_more_btn small">View This Order Info</a></div>
									</div>
								</div>
							</td>
                          <td>
							@php $st=0; @endphp
								<div class="price">
                                    {{-- <del>$45.00</del> $40.00
                                   {{$itm->name}} --}}
								   @foreach($itm->items as $prod)
								   {{-- {{$prod->title}} --}}
								   <li> {{$prod->product->title}}  </li>
							@php if($prod->order_trackings_id == Null && $prod->product->user_id == Auth::user()->id){
								$st=1;
							}
						
						 @endphp
								   
									@endforeach
                                </div>
							</td> 
                            <td>
								<div class="quantity">
                                    {{-- <del>$45.00</del> $40.00 --}}
									@foreach($itm->items as $prod)
									{{-- {{$prod->title}} --}}
									<li style=" list-style-type: none;"> {{$prod->qty}}  </li>
									 @endforeach
								 </div>

                                </div>
							</td>
					
							<td>
                                {{-- {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y - h:i a')}} --}}
                                {{-- {{\Carbon\Carbon::createFromFormat('F d, Y - h:i a', $item->created_at)}} --}}
                                {{-- {{ $item->created_at}} --}}
								{{-- <div class="date">March 20, 2019 - 5:20 pm</div> --}}
								<div class="date">{{ \Carbon\Carbon::parse($itm->created_at)->format('F d, Y')}}
                                </div>

							</td>
							<td>
								{{-- <span>{{  $st }}</span> --}}
								<span class="{{$st == 1 ? "badge red" : "badge green" }}">{{$st == 1 ?  "Please Add Tracking Number" : "Completed" }}</span>
							</td>
						</tr>
                        {{-- @endif --}}
                        @endforeach
						@else
						<tr><td>No Data Found</td></tr>
						@endif
                        {{-- @endforeach --}}
						{{-- <tr>
							<td>
								<div class="ico_blk">
									<div class="ico fill round"><a href="product-detail.php"><img src="assets/images/products/02.jpg" width="200" height="200" alt=""></a></div>
									<div class="txt">
										<div class="name"><a href="product-detail.php">Women's Hooded Loungewear Set - L / Khaki</a></div>
										<div class="btn_blk mt-2"><a href="order-detail.php" class="read_more_btn small">View This Product</a></div>
									</div>
								</div>
							</td>
							<td>
								<div class="price"><del>$45.00</del> $40.00</div>
							</td>
							<td>
								<div class="date">March 20, 2019 - 5:20 pm</div>
							</td>
							<td>
								<span class="badge red">Cancelled</span>
							</td>
						</tr> --}}
						
						
						
					{{-- its are orders --}}
					</tbody>
				</table>
			</div>
			<div class="pagination">
				{{-- <ul>
					<li><button type="button" class="prev"></button></li>
					<li class="active"><a href="?">1</a></li>
					<li><a href="?">2</a></li>
					<li><a href="?">3</a></li>
					<li><a href="?">...</a></li>
					<li><a href="?">50</a></li>
					<li><button type="button" class="next"></button></li>
				</ul> --}}
				{{-- <div class="pagination"> --}}
					{{ $orders->links('vendor.pagination.customPage') }} 
				   
					{{-- {{ $product->links('vendor.pagination.bootstrap-4') }} --}}
				 
				{{-- </div> --}}
			</div>
		</div>
	</section>
@endsection
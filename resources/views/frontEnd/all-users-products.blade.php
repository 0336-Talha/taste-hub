
@extends('frontEnd.layout.site-master')

@section('content')


@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section id="my-products">
    <div class="contain">
        <h3 class="mb-4">My Products</h3>
        <div class="my_products_listing">
            <div class="listing_products">
                @foreach ($product as $prod)
               
                <div class="flex">
                    <div class="col col_lg">
                        <a href="{{route('user.editProduct',$prod->id)}}" class="inner_flex">
                            <div class="image">
                                <img src="{{ asset($prod->firstPhoto->photo_path) }}" alt="Product Photo">
                            </div>
                            <div class="title">
                                <p>{{$prod->title}}
                                </p>
                            </div>
                            {{-- <p><a href="">Edit Product</a></p> --}}

                        </a>
                    </div>
                    <div class="col">
                        <div class="dim_text">
                            <h6>Price</h6>
                        </div> 
                        <p>${{$prod->price}}</p>
                    </div>
                    <div class="col">
                        <div class="dim_text">
                            <h6>Brand</h6>
                        </div> 
                        <p>{{$prod->brand->name}}</p>
                    </div>
                    <div class="col">
                        <div class="dim_text">
                            <h6>Offers</h6>
                        </div>
                        <p>{{$prod->product_all_offer_count}}</p>
                    </div>
                    <div class="col">
                        <div class="dropdown">
                        <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown">...</button>
                            <ul class="account_dropdown dropdown-menu">
                                <li><a href="{{route('user.editProduct',$prod->id)}}">Edit</a></li>
                                <li><a href="/viewProductOffers/{{$prod->id}}">View Offers</a></li>
                                <li><a href="{{route('user.deleteProduct',$prod->id)}}">Delete</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
{{-- Route::post('/updateProduct/{id}',[ProductController::class,'updateProduct'])->name('user.updateProduct'); --}}
     
            </div>
            <div class="pagination">
                {{ $product->links('vendor.pagination.customPage') }} 
               
                {{-- {{ $product->links('vendor.pagination.bootstrap-4') }} --}}
             
            </div>
        </div>
    </div>
</section>
{{-- @foreach ($product as $item)
    {{$item->title}}
@endforeach --}}

@endsection
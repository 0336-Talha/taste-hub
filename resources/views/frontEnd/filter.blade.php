

@extends('frontEnd.layout.site-master')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
	
</head>

<body>



	<section id="catalog">
		<div class="contain">
			<div class="content">
				<h3 id="heading">Products</h3>
				{{-- <p>500+ results.</p> --}}
				<div class="filter_blk">
					<form action="" id="filter" >
						<div class="dropdown">
							<button type="button" id="category" class="dropdown-toggle chevron" data-bs-toggle="dropdown">Category</button>
							<ul class="dropdown-menu">
								<li><button type="button" class="sub-category-btn" data-id="">Category</button></li>
                                @foreach ($category as $category)

                                {{$category->name}}

                                @foreach ($category->subCategories as $cate)
                                <li><button type="button" class="sub-category-btn" data-id="{{$cate->sub_id}}">{{$cate->name}}</button></li>

                                    @endforeach
                                @endforeach

								<input type="hidden" id="selectedSubCategory" name="subCategory" value="">
								{{-- <li><button type="button">Lorem ipsum dolor</button></li>
								<li><button type="button">Harum dolorum, repellat</button></li>
								<li><button type="button">Culpa obcaecati</button></li>
								<li><button type="button">Amet eligendi corporis</button></li>
								<li><button type="button">Blanditiis enim ex</button></li> --}}
							</ul>
						</div>
						<div class="dropdown">
							<button type="button" name="size" id='sizee' class="dropdown-toggle chevron" data-bs-toggle="dropdown">Size</button>
							<ul class="dropdown-menu"> 
								<li><button type="button" class="dropdown-item size-btn">Size</button></li>


								<li><button type="button" class="dropdown-item size-btn">S</button></li>
								<li><button type="button" class="dropdown-item size-btn">M</button></li>
								<li><button type="button" class="dropdown-item size-btn">L</button></li>
								<li><button type="button" class="dropdown-item size-btn">XS</button></li>
								<li><button type="button" class="dropdown-item size-btn">XL</button></li>

							</ul>
							<input type="hidden" id="selectedSize" name="size" value="">

						</div>
						
						{{-- <div class="dropdown">
							<button type="button" class="dropdown-toggle chevron" data-bs-toggle="dropdown">Material</button>
							<ul class="dropdown-menu">
								<li><button type="button">Lorem ipsum dolor</button></li>
								<li><button type="button">Harum dolorum, repellat</button></li>
								<li><button type="button">Culpa obcaecati</button></li>
								<li><button type="button">Amet eligendi corporis</button></li>
								<li><button type="button">Blanditiis enim ex</button></li>
							</ul>
						</div> --}}
						<div class="dropdown">
							<button type="button" name="color" class="dropdown-toggle chevron" data-bs-toggle="dropdown">Color</button>
							<ul class="dropdown-menu">
                                @foreach($color as $col)
								<li><button type="button" class="color-btn" data-id="{{$col->color}}"><div style="background-color: {{$col->color}}; width:100%">{{$col->color}}</div></button></li>

                                @endforeach
								{{-- <li><button type="button">Lorem ipsum dolor</button></li>
								<li><button type="button">Harum dolorum, repellat</button></li>
								<li><button type="button">Culpa obcaecati</button></li>
								<li><button type="button">Amet eligendi corporis</button></li>
								<li><button type="button">Blanditiis enim ex</button></li> --}}
							<input type="hidden" id="selectedColor" name="color" value="">

							</ul>
						</div>
						<div class="dropdown">
							<button type="button" name="brand"  id="brand" class="dropdown-toggle chevron" data-bs-toggle="dropdown">Brands</button>
							<ul class="dropdown-menu">
								<li><button type="button" class="brand-btn" data-id="">Brands</button></li>

                                @foreach($brand as $brand)
								<li><button type="button" class="brand-btn" data-id="{{$brand->id}}">{{$brand->name}}</button></li>
							

                                @endforeach
							</ul>
							<input type="hidden" id="selectedBrand" name="brand" value="">
							
						</div>
						<div class="dropdown">
							<button type="button" class="dropdown-toggle chevron" id="price" data-bs-toggle="dropdown">Price</button>
							<ul class="dropdown-menu">
								<li><button type="button" class="lowhigh" data-id="lowhigh">Low To High</button></li>
								<li><button type="button" class="lowhigh" data-id="highlow" >High To Low</button></li>
							</ul>
							{{-- <div id="selectPrict"></div> --}}
							<input type="hidden" id="selectedPrice" name="price" value="">
						</div>
						
						{{-- <div class="dropdown">
							<button type="button" class="dropdown-toggle chevron" data-bs-toggle="dropdown">Sort By</button>
							<ul class="dropdown-menu">
								<li><button type="button">Lorem ipsum dolor</button></li>
								<li><button type="button">Harum dolorum, repellat</button></li>
								<li><button type="button">Culpa obcaecati</button></li>
								<li><button type="button">Amet eligendi corporis</button></li>
								<li><button type="button">Blanditiis enim ex</button></li>
							</ul>
						</div> --}}
					</form>
					{{-- </div> display: none; --}}  
				<div id="loader" style="width: 150px; display: none;" >
					<img src="{{asset('/loader.gif')}}" alt="Loading..." />
				</div>
				</div>
			</div>
				
		 <div class="row card_row" style="height: 100vh">
				<div class="col">
					{{-- <div class="product_item mini">
						<button type="button" class="like_btn"><img src=" assets/images/icon-heart.svg" alt="Like Button"></button>
						<div class="image">
							<a href="product-detail.php">
								<img src="assets/images/products/01.jpg" alt="Product Photo">
							</a>
						</div>
						<div class="text">
							<div class="title"><a href=" product-detail.php">Women's Hooded Loungewear Set - L / Khaki</a></div>
							<div class="btm">
								<div class="ico_blk">
									<div class="ico fill round"><img src="https://www.herosolutions.com.pk/metoo/tracksuit/assets/images/users/01.webp" width="150" height="150" alt="User Photo"></div>
									<div class="name">Jennifer Kem</div>
								</div>
								<div class="price">$200</div>
							</div> --}}
						</div>
					</div>

			
				

			
		
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
	<!-- catalog -->

	
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



@endsection


@section('script')
<script>
console.log('hi')
	    // Function to get query parameter by name
		function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name); // Returns the value of the parameter
    }

	const brandParam = getQueryParam('brand');
	// console.log(brandParam)
	if (brandParam) {
    let head = document.getElementById('heading');
    head.innerText = 'Search By Brand'; // Use innerText to update the text content
}
$(document).ready(function(){
	let category;



	const searchParam = getQueryParam('search');
	const brandParam = getQueryParam('brand');
	const categoryParam=getQueryParam('category');
	console.log(brandParam);
	console.log(categoryParam)

	   // 2. Check if brandId exists
	   if (brandParam) {
		let head = document.getElementById('heading');

        // 3. Find the matching button in the list
        const brandButtons = document.querySelectorAll('.brand-btn');
        brandButtons.forEach(button => {
            if (button.dataset.id === brandParam) {
                // 4. Set the button as active (you can style it with CSS)
                button.classList.add('active');
                
                // Optional: Update the dropdown label
                document.getElementById('brand').textContent = button.textContent;
				head.innerText = button.textContent; // Use innerText to update the text content


                // Optional: Update the hidden input field
                document.getElementById('selectedBrand').value = brandParam;
            }
        });
    }

	if (categoryParam) {
		let head = document.getElementById('heading');

        // 3. Find the matching button in the list
        const categoryButtons = document.querySelectorAll('.sub-category-btn');
        categoryButtons.forEach(button => {
            if (button.dataset.id === categoryParam) {
                // 4. Set the button as active (you can style it with CSS)
                button.classList.add('active');
                
                // Optional: Update the dropdown label
                document.getElementById('category').textContent = button.textContent;
				head.innerText = button.textContent; // Use innerText to update the text content


                // Optional: Update the hidden input field
                document.getElementById('selectedSubCategory').value = categoryParam;
            }
        });
    }


        
        if (searchParam) {
            // Call the changer function with the search parameter
            changer(searchParam);
			$('#heading').text(searchParam)
        } else {
            // Call the changer without search if no parameter is provided
            changer();
        }

		if (brandParam) {

			// $('.brand-btn').on('click', function () {
		// console.log('elow')
        // Get the data-id of the clicked button
        //  var selectedBrandId = $(this).data('id'); // Fetch data-id attribute
        // console.log('Selected brand ID:', selectedBrandId);
        // // Update the hidden input value
         $('#selectedBrand').val(brandParam);
		// console.log($('#selectedBrand').val())
        // console.log('brand Selected:', $(this).text());
		 changer();
            // Call the changer function with the search parameter
            // changer(brandParam);
			// $('#heading').text("")

        } 
		if (categoryParam) {

// $('.brand-btn').on('click', function () {
// console.log('elow')
// Get the data-id of the clicked button
//  var selectedBrandId = $(this).data('id'); // Fetch data-id attribute
// console.log('Selected brand ID:', selectedBrandId);
// // Update the hidden input value
$('#selectedSubCategory').val(categoryParam);
// console.log($('#selectedBrand').val())
// console.log('brand Selected:', $(this).text());
changer();
// Call the changer function with the search parameter
// changer(brandParam);
// $('#heading').text("")

} 
		// else {
        //     // Call the changer without search if no parameter is provided
        //     changer();
        // }
   
	// $('#loader').show();
	// style="display: none;"
	// $('#loader').css({ 'display' : 'none',});

function changer(filters=null){
	console.log('Filters applied:', filters);
	
	var subid=$('#selectedSubCategory').val();
	var brandid=$('#selectedBrand').val();
	var size=$('#selectedSize').val();
	
	var selectedPrice=$('#selectedPrice').val();

	if(size == 'Size'){
		size='';
	}
	var color=$('#selectedColor').val();
	// console.log(size);
	// console.log(brandid);
	// console.log(subid);
	$('#loader').css({ 'display' : '',});

	$('.card_row').html('');
	// $('#loader').show();

	$.ajax({
            url: "{{route('filter')}}", // Replace with your server endpoint
            type: 'GET', // HTTP method
            data: { subCategory: subid,
				brandid,
				size,
				color,
				price:selectedPrice,
				search:filters,
			
			}, // Data to send
			beforeSend: function () {
                // Show the loader before the request starts
                $('#loader').css('display', 'block');
            },
            success: function (response) {
                // Handle success response
                // console.log('Response from Server:', response);

				// $('#loader').hide();
	// $('#loader').css({ 'display' : 'none',});
				


// Check if response has HTML content
if (response.html) {
	$('.card_row').html(response.html); // Load the new HTML content
} else {
	$('.card_row').html('<p>No results found.</p>'); // Optional fallback
}

                // Optionally update the DOM based on the response
                 // $('#someElement').html(response); // Replace `#someElement` with your target element ID
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error('AJAX Error:', error);
            },
			complete: function () {
                // Hide the loader after the request is complete
                // $('#loader').hide();
				$('#loader').css('display', 'none');
            }
        });

}
// changer();
 
//for category

	$('.sub-category-btn').on('click', function () {
        // Get the data-id of the clicked button
        var selectedId = $(this).data('id'); // Fetch data-id attribute
        // console.log('Selected Sub-Category ID:', selectedId);
        // Update the hidden input value
        $('#selectedSubCategory').val(selectedId);
		$('#category').text($(this).text());
        // console.log('Sub-Category Selected:', $(this).text());
		changer();
    });

	//price Filter
	// <div class="dropdown">
	// 						<button type="button" class="dropdown-toggle chevron" id="price" data-bs-toggle="dropdown">Price</button>
	// 						<ul class="dropdown-menu">
	// 							<li><button type="button" class="lowhigh" data-id="lowhigh">Low To High</button></li>
	// 							<li><button type="button" class="lowhigh" data-id="highlow" >High To Low</button></li> 
	// 						</ul>
	// 						{{-- <div id="selectPrict"></div> --}}
	// 						<input type="hidden" id="selectedPrice" name="price" value="">
	// 					</div>
	$('.lowhigh').on('click', function () {
        // Get the data-id of the clicked button
        var selectedPrice = $(this).data('id'); // Fetch data-id attribute
        // console.log('Selected Sub-Category ID:', selectedId);
        // Update the hidden input value
        $('#selectedPrice').val(selectedPrice);
		$('#price').text($(this).text());
        // console.log('Sub-Category Selected:', $(this).text());
		changer();
    });

	//for brand.

	$('.brand-btn').on('click', function () {
		console.log('elow')

        // Get the data-id of the clicked button
         var selectedBrandId = $(this).data('id'); // Fetch data-id attribute
		//  $(this).text('') 
		$('#brand').text($(this).text());

        // console.log('Selected brand ID:', selectedBrandId);
        // // Update the hidden input value
         $('#selectedBrand').val(selectedBrandId);
		// console.log($('#selectedBrand').val())
        // console.log('brand Selected:', $(this).text());
		 changer();
    });

	

	$('.size-btn').on('click', function () {
		// console.log('elow')
		//select value.
		var selectedSize = $(this).text(); 
		// console.log(selectedSize);
     $('#selectedSize').val(selectedSize);
	 $('#sizee').text(selectedSize);
	//  console.log( $('#selectedSize').val());
	 changer();
    });

	$('.color-btn').on('click', function () {
		// console.log('elow')
		//select value.
		var selectedColor = $(this).data('id');
		// console.log(selectedColor)
		// console.log(selectedSize);
     $('#selectedColor').val(selectedColor);
	//  console.log( $('#selectedColor').val());
	 changer();
    });


	
		
		
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
                } 

				setTimeout(function () {
        // alert('Reloading Page');
        location.reload(true);
      }, 1000);

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
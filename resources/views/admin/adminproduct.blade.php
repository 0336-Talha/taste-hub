@extends('admin.layouts.layoutsHome.app')

@section('content')
<div class="main p-3">
    
    <h1 style="text-align: center;">Product Manager</h1>

    <button class="btn btn-primary mb-3" id="addProduct" >Add Product</button>
    <label for="filter">Filter:</label>

    <select id="filter" name="filter">
    <option value="All">All Products</option>
    <option value="admin">Admin Products</option>
    <option value="user">User Products</option>
    </select>

    <div class="container">
        <div id="product-container"></div>
    </div>

</div>
<br>


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
</div>
@endsection


@section('script')
<script>
        function getProducts(filter){
            // console.log(filter)
            let a="all";
        
            if(filter == undefined){
                a='all';
            }else{
                a=filter;
            }
        $.ajax({
        type:"GET",
        // url:"{{route('admin.Product', 'all')}}",
        url:`/admin/product/${a}`,
        success: function(prod) {
    // Select the container where the table will be appended
    let productContainer = $('#product-container');
    productContainer.empty();  // Clear any existing content

    // Start building the table structure
    let table = `
        <div>
            <h5>Products Table</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>discription</th>
                        <th>price</th>

                        
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
    `;

    // Loop through the brand data to populate the table rows
    prod.forEach(function(data, index) {
        // Use template literals to dynamically include the image URL
        //  let img = `{{ asset('${data.image}') }}`.replace('${data.image}', data.image);
        // let img=`/${data.image}`;

        let img ="{{asset('')}}"+data['first_photo']['photo_path'];
        console.log(data['first_photo']['photo_path']);


        // Append each row to the table
        table += `
            <tr>
                <td>${index + 1}</td>
                <td id="name">${data.title}</td>
                <td><img src="${img}" id="Oldimage" style="height:100px; width:100px"></td>
                <td id="name">${data.discription}</td>
                <td id="name">${data.price}</td>


                <td>
                    <button  class="btn btn-info" data-id=${data.id} id="edit" >Edit</button>
                                    <button class="btn btn-danger" data-id=${data.id} id="delete">Delete</button>
                    </td>
              

            </tr>
        `;
    });

    // Close the table structure
    table += `
                </tbody>
            </table>
        </div>
    `;

    // Append the complete table to the container
    productContainer.append(table);
},
        error:function(error){
            console.log(error);
        }
        })
    }

    getProducts();

    $(document).on('change','#filter',function(){
        // console.log($(this).val());
        $filter=$(this).val();
        getProducts($filter);
    })

    $('#addProduct').on('click',function(){
    $('#modalHeading').html('Add A Product');
    let formHtml = `
        <form id="productForm">

            <div class="form-group">
                <label for="title">Product Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
               
            </div>

            <div class="form-group">
                <label for="quantity">Quantity <sup>*</sup></label>
                <input type="text" class="form-control" id="quantity" name="quantity" required>
           
            </div>

            <div class="form-group">
                <label for="price">Price <sup>*</sup></label>
                <input type="text" class="form-control" id="price" name="price" required>
              
            </div>

            <div class="form-group">
                <label for="discription">Description <sup>*</sup></label>
                <textarea name="discription" class="form-control" rows=5></textarea>
            </div>

            <div class="form-group">
                <label for="brand">Select Brand</label>
                <select class="form-control" name="brand" id="brand">
                    <option value="">Choose Brand</option>
            
                </select>
            </div>

            
            <div class="form-group">
                <label for="subCategory">Select Category</label>
                <select class="form-control" name="category" id="subCategory">
                    <option value="">Choose Sub Categories</option>
            
                </select>
            </div>


            
            <div class="form-group">
                <label for="image">Add products Images </label>
                <input class="hidden" type="file" name="photos[]"  id="photos"  accept="gif|jpg|png" multiple="">
                <img src="{{asset('noimage.jpg')}}" alt="" id="bSrc" style="height: 60px; width:60px">
                <label id="photos-error" class="error" for="photos"></label>
                <div class="col_show" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">

             </div>
                <div style="display:flex">
                
              

                <div class="col_m_l mt-4">
                 <input type="color"  id="colorPicker" multiple>
                <p>Select color</p>
                </div>
                <div class="col_m_r" id="colorContainer">
                     
                </div>
                </div>

                <div class="lbl_btn">
              <input type="checkbox"  name="size[]" value="XS" id="size1" class="hidden">
                <label for="size1">XS</label> 
                </div>
                                <div class="lbl_btn">
                                    <input type="checkbox" name="size[]" value="S"  id="size2" class="hidden">
                                    <label for="size2">S</label> 
                                </div>
                                <div class="lbl_btn">
                                    <input type="checkbox" name="size[]" value="M"  id="size3" class="hidden">
                                    <label for="size3">M</label>
                                </div>
                                <div class="lbl_btn">
                                    <input type="checkbox" name="size[]"  value="L" id="size4" class="hidden">
                                    <label for="size4">L</label>
                                </div>
                                <div class="lbl_btn">
                                    <input type="checkbox" name="size[]" value="XL" id="size5" class="hidden">
                                    <label for="size5">XL</label>
                                </div>
                            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        
        </form>
    `;
    $('.modal-body').html(formHtml);
    $('#ajaxModel').modal('show');


    })



    var inpus=$('input[type=checkbox]');

let filesArray = [];
let selectedFiles = [];

   $(document).on('change','#photos',function(e){
    console.log('hi')
    $('.col_show').html('');

   
    var files = $(this)[0].files;
    selectedFiles = Array.from($(this)[0].files);
        $(".col_show").empty();
        selectedFiles.forEach(function(file, index) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(`
            <div class="img_show" data-index="${index}" style="width: 100%; position: relative;">
            <div class="inner" style="height:100px; width:100px;">
                <img src="${e.target.result}" alt="Product Photo" style="width:100%; height:100%; object-fit: cover;">
                <span class="x_btn closebtn" style="position:absolute; top:5px; right:5px; cursor:pointer;">&times;</span>
            </div>
        </div>
            `).appendTo(".col_show");
        };
        reader.readAsDataURL(file);
    });
    });

    
$(document).on("click",'.closebtn',function(e){
    console.log("hi")
    const indexToRemove = $(this).closest('.img_show').data('index');
    console.log(indexToRemove)

        // Remove the corresponding file from the selectedFiles array
        selectedFiles.splice(indexToRemove, 1);

// Refresh the previews
        refreshPreviews();
 

        // $(this).parent().parent().remove();

        
    });

    function refreshPreviews() {
    $('.col_show').html(''); // Clear current previews
    selectedFiles.forEach(function(file, index) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(`
            <div class="img_show" data-index="${index}" style="width: 100%; position: relative;">
            <div class="inner" style="height:100px; width:100px;">
                <img src="${e.target.result}" alt="Product Photo" style="width:100%; height:100%; object-fit: cover;">
                <span class="x_btn closebtn" style="position:absolute; top:5px; right:5px; cursor:pointer;">&times;</span>
            </div>
        </div>
            `).appendTo(".col_show");
        };
        reader.readAsDataURL(file);
    });

    // Update the input with the remaining files
    let dataTransfer = new DataTransfer();
    selectedFiles.forEach(function(file) {
        dataTransfer.items.add(file);
    });
    $('#photos')[0].files = dataTransfer.files; // Update the input's files with the new list
}



$(document).on('change','#colorPicker', function() {
     
       let color = $(this).val();
       console.log(color)
   // Create a new color block
   let colorBlock = `
   <div class="outer_blk_color" style="display: inline-block; margin-right: 10px;">
        <div class="color_blk" style="background-color:${color}; width: 50px; height: 50px; position: relative;">
            <span class="x_btn" onclick="removeColor(this)" style="position: absolute; top: 5px; right: 5px; cursor: pointer;">&times;</span>
        </div>
        <input type="hidden" name="colors[]" value="${color}">
    </div>`;

    // Append the color block to the container
    $('#colorContainer').append(colorBlock);
   });

   function removeColor(element) {
    $(element).closest('.outer_blk_color').remove();
}


$(document).on('focus','#brand',function(){
    $('#brand').empty();
    $.ajax({
        url: "{{ route('admin.Brand') }}", // Adjust this route as necessary
        method: 'GET',
        success: function(response) {
            // console.log(response) //colection 
            // <option value="">Choose Categories</option>

            let options = '';
            options +=`<option value="">Choose Brand</option>`;
           console.log(response);
            $.each(response, function(index, category) {

             
                options += `<option value="${category.id}"> ${category.name}</option>`; //select name store id
            })
            $('#brand').append(options)
        }
    })
})

$(document).on('focus','#subCategory',function(){
    $('#subCategory').empty();
    $.ajax({
        url: "{{ route('admin.getSubCategory') }}", // Adjust this route as necessary
        method: 'GET',
        success: function(response) {
            // console.log(response) //colection 
            // <option value="">Choose Categories</option>

            let options = '';
            options +=`<option value="">Choose Category </option>`;
           console.log(response);
            $.each(response, function(index, category) {

             
                options += `<option value="${category.sub_id}"> ${category.name}</option>`; //select name store id
            })
            $('#subCategory').append(options)
        }
    })
})



// productForm
$(document).on('submit','#productForm',function(e){
    e.preventDefault();
    // console.log("hello");
    let form=$(this)[0];

  
    
    let _token = $('meta[name="csrf-token"]').attr('content');
    let formData = new FormData(form);

    formData.append('_token', _token);


                    console.log(formData);

                    $.ajax({
                        url: "{{ route('admin.storeproduct') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function(response) {
                         $('#errorMessages').html('');

                            console.log(response.success)
                            if(response.success){
                                // window.location.href = response.redirect_url;
                                $('#ajaxModel').modal('hide');
                                getProducts();
                                
                            }
                            
                        },
                        error:function(error){
                            // console.log(error.responseJson)
                            // let err =error.responseJSON.errors;
                            // console.log(err.photos2)

                            if (error.status === 422) { // Laravel validation error status code
                         let errors = error.responseJSON.errors;
                         $('#errorMessages').html('');
                    
                      $.each(errors, function(key, value) {
                        $('#errorMessages').append('<p>' + value[0] + '</p>');
                        });
                } else {
                    console.log('Unexpected error occurred.');
                }
                        }
                    });
});
let existingImagesArray = []; // Store existing images
    let newImagesArray = []; 

let exsistingColorArray=[];

function removeExistingImage(imageId, element) {
                console.log('hi i am tal');
                $(element).closest('.outer_blk_color').remove();
           
            }
            function loadExistingImages(images) {
                existingImagesArray=[];
            images.forEach((image, index) => {
             $('.col_show').append(`
                <div class="image-wrapper" data-index="${index}">
                    <img src="{{asset('/')}}${image.photo_path}" alt="Existing Image" style="height: 60px; width: 60px;">
                    <span class="remove-existing-image" style="cursor: pointer; color: red;">Remove</span>
                </div>
            `);
            $('.col_show').removeClass('newImage');
            existingImagesArray.push(image); // Push to the array
        });
    }



    //    let colors= product.product_colors;
    

    //         $.each(colors, function(index, color) {
    //             console.log(color.color)
    //             let colorBlock = `
    //                     <div class="outer_blk_color" style="display: inline-block; margin-right: 10px;">
    //      <div class="color_blk" style="background-color:${color.color}; width: 50px; height: 50px; position: relative;">
    //         <span class="x_btn" onclick="removeColoring(this)" style="position: absolute; top: 5px; right: 5px; cursor: pointer;">&times X</span>
    //     </div>
     
    // </div>`;
    //             $('.colring').append(colorBlock);

  
    //         });

    // yahhhhhh rhaaaaaaaaaaaaaaaaaaaa
    let filesArray2 = [];
    let selectedFiles2 = [];
    $(document).on('change','#photosing',function(e) {
        console.log('hi from photosing')
        $('.newImage').html('');
        let files = e.target.files;
        var files2 = $(this)[0].files;
        selectedFiles2 = Array.from($(this)[0].files);
        $(".newImage").empty();
        // yahhhhhhhhhnnnnnnnnnnnnnnnn
        selectedFiles2.forEach(function(file, index) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('.newImage').append(`
                    <div class="image-wrapper" data-index="${index}">
                        <img src="${e.target.result}" alt="New Image" style="height: 60px; width: 60px;">
                        <span class="remove-new-image" style="cursor: pointer; color: red;">Remove</span>
                    </div>
                `);
            };
            reader.readAsDataURL(files[index]);
            newImagesArray.push(files[index]);
        })
    });


    $(document).on('submit','#productEditForm',function(e) {
        e.preventDefault();

      
        let _token = $('meta[name="csrf-token"]').attr('content');
 

 

        let productId=$('#productId').val();
        console.log(productId)
        let formData = new FormData(this);
        formData.append('_token', _token);

        // Append new images
        // for (let i = 0; i < newImagesArray.length; i++) {
        //     formData.append('photos[]', newImagesArray[i]);
        // }

        // Append existing images to keep
        existingImagesArray.forEach(function(image) {
            formData.append('existing_photos[]', image.id);  // Send image IDs to keep
        });

        $.ajax({
            url: '/admin/product/update/' + productId, // Adjust route as needed
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert('Product updated successfully!');
            }
        });
    });




    $(document).on('click', '.remove-existing-image', function() {
        let index = $(this).closest('.image-wrapper').data('index');
       
        existingImagesArray.splice(index, 1); // Remove the image from the array
        $(this).closest('.image-wrapper').remove(); // Remove from DOM
    });



    $(document).on('click', '.remove-new-image', function() {
        let index = $(this).closest('.image-wrapper').index();
        console.log(index)
        newImagesArray.splice(index, 1); // Remove from array
        // $(this).closest('.image-wrapper').remove();
         refreshPreviewsin();


            // Update the input with the remaining files
    // let dataTransfer = new DataTransfer();
    // newImagesArray.forEach(function(file) {
    //     dataTransfer.items.add(file);
    // });
    // $('#photosing')[0].files = dataTransfer.files; // Update the input's files with the new list
    });


    function refreshPreviewsin() {
    $('.newImage').html(''); // Clear current previews
    newImagesArray.forEach(function(file, index) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(`
            <div class="image-wrapper" data-index="${index}">
                        <img src="${e.target.result}" alt="New Image" style="height: 60px; width: 60px;">
                        <span class="remove-new-image" style="cursor: pointer; color: red;">Remove</span>
                    </div>
            `).appendTo(".newImage");
        };
        reader.readAsDataURL(file);
    });

    // Update the input with the remaining files
    let dataTransfer = new DataTransfer();
    newImagesArray.forEach(function(file) {
        dataTransfer.items.add(file);
    });
    // $('#photos')[0].files = dataTransfer.files;
    $('#photosing')[0].files = dataTransfer.files; // Update the input's files with the new list
}

    
 function removeColoring(element) {
    $(element).closest('.outer_blk_color').remove();
}


  
        

$(document).on('click','#edit',function(){
    let id = $(this).attr("data-id");
 

    var editProductUrl = "{{ route('admin.editPrt', ':id') }}";
    $('#modalHeading').html('Edit A Product');
    let url = editProductUrl.replace(':id', id);

    $.ajax({
        
        url: url, 
        type: 'GET',
        success: function(response) {
            // Assuming the response contains the product data
         
          let product = response.product;
        //   let sizee=product.product_size; product.product_size.map(item => item.size);
          let sizee = product.product_size.map(item => item.size);
          let pho = product.product_photos.map(item => item.photo_path);

          console.log(product)
            
          let formHtml = `
        <form id="productEditForm">

            <input type="text" class="form-control" id="productId" name="productId" hidden value="${product.id}">
            <div class="form-group">
                <label for="title">Product Title</label>
                <input type="text" class="form-control" id="title" name="title" required value="${product.title}">
               
            </div>

            <div class="form-group">
                <label for="quantity">Quantity <sup>*</sup></label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="${product.quantity}"required>
           
            </div>

            <div class="form-group">
                <label for="price">Price <sup>*</sup></label>
                <input type="text" class="form-control" id="price" name="price" value="${product.price}" required>
              
            </div>

            <div class="form-group">
                <label for="discription">Description <sup>*</sup></label>
                <textarea name="discription" class="form-control"  rows=5> ${product.discription}</textarea>
            </div>

            <div class="form-group">
                <label for="brand">Select Brand</label>
                <select class="form-control" name="brand" id="brand">
                    <option selected value="${product.brand_id}">${product.brand.name}</option>
            
                </select>
            </div>

            
            <div class="form-group">
                <label for="subCategory">Select Category</label>
                <select class="form-control" name="category" id="subCategory">
                    <option value="${product.sub_id}">${product.sub_category.name}</option>
            
                </select>
            </div>

            <div class="form-group">
            <p>images</p>
            <div class="col_showing" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">
            </div>
            <div class="form-group">
                <label for="image">Add products Images </label>
                <input class="hidden" type="file" name="photos[]"  id="photosing"  accept="gif|jpg|png" multiple="">
                <img src="{{asset('noimage.jpg')}}" alt="" id="bSrc" style="height: 60px; width:60px">
                <label id="photos-error" class="error" for="photos"></label>
                <div class="newImage" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">
                    </div>

                <div class="col_show" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">


         
             </div>
                <div style="display:flex">
                
              
                    <div class="form-group">
                      <p>Colors</p>
                     <div class="colring" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">
                    
                      </div>

                <div class="col_m_l mt-4">
                 <input type="color"  id="colorPickering" multiple>
                <p>Select color</p>
                </div>
                <div class="col_m_r" id="colorContainer">
                     
                </div>
                </div>

                <div class="lbl_btn">
              <input type="checkbox"  name="size[]" value="XS"  ${sizee.includes('XS') ? `checked="true"` :"" } id="size1" class="hidden">
                <label for="size1">XS</label> 
                </div>
                                <div class="lbl_btn">
                                    <input type="checkbox" name="size[]" value="S" ${sizee.includes('S') ? `checked` :"" } id="size2" >
                                    <label for="size2">S</label> 
                                </div>
                                <div class="lbl_btn">
                                    <input type="checkbox" name="size[]" value="M" ${sizee.includes('M') ? `checked` :""} id="size3" >
                                    <label for="size3">M</label>
                                </div>
                                <div class="lbl_btn">
                                    <input type="checkbox" name="size[]" ${sizee.includes('L') ? `checked` : "" } value="L" id="size4" >
                                    <label for="size4">L</label>
                                </div>
                                <div class="lbl_btn">
                                    <input type="checkbox" name="size[]" value="XL" id="size5" ${sizee.includes('XL') ? `checked` : ""} >
                                    <label for="size5">XL</label>
                                </div>
                            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        
        </form>
    `;
    $('.modal-body').html(formHtml);
    //  Append the existing product images
    let existingImagesArray = []; // Store existing images
    let newImagesArray = []; // Store new images
    // let images = product.product_photos; // Assuming photos is an array of images
     let existingPhotos = product.product_photos;
     let exsistingColors=product.product_colors;
        loadExistingImages(existingPhotos);
        console.log(existingPhotos)
        // loadExistingColors(exsistingColors);


                existingColorArray=[];
            exsistingColors.forEach((color, index) => {
                
             $('.colring').append(`
             <div class="outer_blk_color" style="display: inline-block; margin-right: 10px;">
              <div class="color_blk" style="background-color:${color.color}; width: 50px; height: 50px; position: relative;">
            <span class="x_btn" onclick="removeColoring(this)" style="position: absolute; top: 5px; right: 5px; cursor: pointer;">&times X</span>
        </div>
        <input type="hidden" name="existing_colors[]" value="${color.id}">
    </div>`);
           
           
        });
    
        $('#colorPickering').on('change', function() {
        let selectedColor = $(this).val();

        // Add the new color to the container
        let newColorBlock = `
        <div class="outer_blk_color" style="display: inline-block; margin-right: 10px;">
              <div class="color_blk" style="background-color:${selectedColor}; width: 50px; height: 50px; position: relative;">
            <span class="x_btn" onclick="removeColoring(this)" style="position: absolute; top: 5px; right: 5px; cursor: pointer;">&times X</span>
        </div>
        <input type="hidden" name="new_colors[]" value="${selectedColor}">
    </div>`;
        $('.colring').append(newColorBlock);
    });
        
    //  let colors= product.product_colors;
    

    //         $.each(colors, function(index, color) {
    //             console.log(color.color)
    //             let colorBlock = `
    //                     <div class="outer_blk_color" style="display: inline-block; margin-right: 10px;">
    //      <div class="color_blk" style="background-color:${color.color}; width: 50px; height: 50px; position: relative;">
    //         <span class="x_btn" onclick="removeColoring(this)" style="position: absolute; top: 5px; right: 5px; cursor: pointer;">&times X</span>
    //     </div>
     
    // </div>`;
    //             $('.colring').append(colorBlock);

  
    //         });


      
    $('#ajaxModel').modal('show');


        },
        error: function(xhr, status, error) {
            console.error('Error fetching product data:', error);
        }
    });



    
    
})


$(document).on('click','#delete',function(){
    let id = $(this).attr("data-id");
    console.log(id)
    let a=confirm("Are You Sure you want to delete this Product")
    if(a){
        $(this).parent().remove()
        $.ajax({
            url: '/admin/product/delete/' +id,
            type: 'get',
            success: function(response) {
                alert(response.success);

                // Optionally: Refresh the product list or redirect
            },
            error: function(error) {
                alert(error.responseJSON.error);
            }
        });
    }

})
   

</script>
@endsection

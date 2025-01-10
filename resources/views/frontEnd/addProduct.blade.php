@extends('frontEnd.layout.site-master')

@section('content')

<section id="product_add">
    <div class="contain">
        <div class="listing_heading">
            <h3>Create a listing</h3>
            <p>Add some photos and details about your item. Fill out what you can for now - you’ll be able to edit this later.</p>
        </div>
        <form id="addProduct" >
            @csrf
            <div class="block_item">
                <div class="head_ing">
                    <h5>Photos</h5>
                    <p>Add as many as you can so buyers can see every detail.</p>
                </div>
                <div class="upload_img_flex flex">
                    <div class="colL">
                        <h6 class="main_lbl">Photos <sup>*</sup></h6>
                        <div class="mini_hint">
                            <p>Utilize a maximum of ten photos to highlight the essential features of your item.</p>
                            <p>Tips:</p>
                            <ul>
                                <li>Opt for natural lighting without using a flash.</li>
                                <li>Incorporate a common object to provide a sense of scale.</li>
                                <li>Demonstrate the item being held, worn, or used.</li>
                                <li>Capture images against a clean and simple background.</li>
                                <li>Ensure photos are added to variations, allowing buyers to explore all available options.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="colR">
                        <div class="upload_outer_blk">
                            <div class="col_upload">
                                <div class="btn_blk">
                                    <button type="button" onclick="document.getElementById('photos').click()">
                                        <input class="hidden" type="file" name="photos[]"  id="photos"  accept="gif|jpg|png" multiple="">
                                        <img src="{{asset('front/assets/images/fi-br-camera.svg')}}"   alt="">
                                        <span for="photos">Upload Image</span>
                                        <label id="photos-error" class="error" for="photos"></label>
                                    </button>
                                </div>

                            </div>
                            <div class="col_show">
                                {{-- <div class="img_show">
                                    <div class="inner">
                                        <img src="{{asset('front/assets/images/products/02.jpg')}}" alt="Product Photo">
                                        <span class="x_btn"></span>
                                    </div>
                                </div> --}}
                 
                              
                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="block_item">
                <div class="head_ing">
                    <h5>Listing Details</h5>
                    <p>Tell the world all about your item and why they’ll love it.</p>
                </div>
                <div class="fields_blk">
                    <div class="flex">
                        <div class="title_col">
                            <h6 class="main_lbl">Title <sup>*</sup></h6>
                            <div class="mini_hint">
                                <p>Include keywords that buyers would use to search for your item.</p>
                            </div>
                        </div>
                        <div class="field_col">
                            <div class="form_blk">
                                <input type="text" name="title"  id="title"  class="input">
                                <label id="title-error" class="error" for="title"></label>
                            </div>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="title_col">
                            <h6 class="main_lbl">About this listing <sup>*</sup></h6>
                            <div class="mini_hint">
                                <p>What type(Brand,made) of item is it?</p>
                            </div>
                        </div>
                        <div class="field_col">
                            <div class="form_blk wide_5">
                                <select name="brand" class="input">
                                    <option value="">Who made it?</option>
                                    @foreach($brand as $brands)
                                    <option value="{{$brands['id']}}">{{$brands['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="title_col">
                            <h6 class="main_lbl">Category <sup>*</sup></h6>
                            <div class="mini_hint">
                                <p>Categories will help more shoppers find it.</p>
                            </div>
                        </div>
                        <div class="field_col">
                            <div class="form_blk wide_5">
                                <select name="category" class="input">
                                    <option value="">Choose Categories</option>
                                    @foreach($category as $categories)
                                    <option value="{{$categories['sub_id']}}">{{$categories['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="title_col">
                            <h6 class="main_lbl">Description <sup>*</sup></h6>
                            <div class="mini_hint">
                                <p>Begin with a concise overview that outlines the standout features of your item. Since shoppers initially encounter only the initial few lines of your description, ensure it leaves a lasting impression. Make those opening lines count!</p>
                            </div>
                        </div>
                        <div class="field_col">
                            <div class="form_blk">
                                <textarea name="discription" id="" rows="10" class="input"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block_item">
                <div class="head_ing">
                    <h5>Inventory and pricing</h5>
                </div>
                <div class="fields_blk">
                    <div class="flex">
                        <div class="title_col">
                            <h6 class="main_lbl">Price <sup>*</sup></h6>
                            <div class="mini_hint">
                                <p>Ensure you consider the expenses related to materials, labor, and other operational costs. If you provide free delivery, incorporate the postage cost to prevent it from impacting your profits adversely.</p>
                            </div>
                        </div>
                        <div class="field_col">
                            <div class="form_blk wide_5">
                                <input type="text" name="price" id="" placeholder="0" class="input price_field">
                                <span class="field_price">USD</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="title_col">
                            <h6 class="main_lbl">Quantity <sup>*</sup></h6>
                            <div class="mini_hint">
                                <p>For quantities exceeding one, this listing will automatically renew until sold out. A listing fee of USD 0.20 will be charged for each renewal.</p>
                            </div>
                        </div>
                        <div class="field_col">
                            <div class="form_blk wide_5">
                                <input type="text" name="quantity" id="" class="input">
                            </div>
                        </div>
                    </div>

                    <!-- <div class="flex">
                        <div class="title_col">
                            <h6 class="main_lbl">SKU</h6>
                            <div class="mini_hint">
                                <p>SKUs are for your use only — buyers won’t see them.</p>
                            </div>
                        </div>
                        <div class="field_col">
                            <div class="form_blk wide_5">
                                <input type="text" name="" id="" class="input">
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="block_item">
                <div class="head_ing">
                    <h5>Variations</h5>
                    <p>Add available options like color or size. Buyers will choose from these during checkout.</p>
                </div>
                <div class="fields_blk">
                    <div class="flex">
                        <div class="title_col">
                            <h6 class="main_lbl">Color <sup>*</sup></h6>
                            <div class="mini_hint">
                                <p>you can show shoppers that your item is multicoloured.</p>
                            </div>
                        </div>
                        <div class="field_col">
                            <div class="check_blk">
                                <div class="col_m_l">
                                    <input type="color"  id="colorPicker" multiple>
                                    <p>Select color</p>
                                </div>
                                <div class="col_m_r" id="colorContainer">
                                    {{-- <div class="outer_blk_color" id="colorContainer">
                                        <!-- Selected colors will be appended here -->
                                    </div> --}}
                                </div>
                                {{-- <div class="col_m_r">
                                    <div class="outer_blk_color">
                                        <div class="color_blk green">
                                            <span class="x_btn"></span>
                                        </div></div> --}}
                                        {{-- <div class="outer_blk_color">
                                        <div class="color_blk grey">
                                            <span class="x_btn"></span>
                                        </div></div> --}}
                                        {{-- <div class="outer_blk_color">
                                        <div class="color_blk yellow">
                                            <span class="x_btn"></span>
                                        </div></div>
                                        <div class="outer_blk_color">
                                        <div class="color_blk blue">
                                            <span class="x_btn"></span>
                                        </div></div>
                                        <div class="outer_blk_color">
                                        <div class="color_blk dark_grey">
                                            <span class="x_btn"></span>
                                        </div> --}}
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    
                    
                    <div class="flex">
                        <div class="title_col">
                            <h6 class="main_lbl">Size <sup>*</sup></h6>
                            <div class="mini_hint">
                                <p>you can show shoppers that your item is in multiple sizes.</p>
                            </div>
                        </div>
                        <div class="field_col">
                            <div class="check_blk">
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
                        </div>
                    </div>
                </div>
                </div>
            

            <div class="btn_blk center">
                <button class="site_btn block">Submit</button>
            </div>
        </form>
    </div>
    <div  class="text-danger" id="errorMessages"></div>
          
</section>
<!-- wishlist -->

@endsection

@section('script')
<script>
$(document).ready(function(){
    $.validator.addMethod("fileType", function(value, element, param) {
        let files = $(element)[0].files; // Get the files
        for (let i = 0; i < files.length; i++) {
            let fileType = files[i].type; // Get the file type
            let allowedTypes = param.split('|'); // Allowed types in the parameter
            if (!allowedTypes.includes(fileType)) {
                return false; // If a file type doesn't match, return false
            }
        }
        return true; // If all file types match, return true
    }, "Only JPG, JPEG, and PNG file formats are allowed."); // Error message

    $("#addProduct").validate({
        rules: {
                title: {
                    required: true,
                    minlength: 5
                }, 
                photos: {
                    required: true,
                    // accept: "image/jpeg, image/png"
                    // extension: "jpec|png"
                    fileType: "image/jpeg|image/png|image/jpg"
                },
                brand:{
                    required:true,
                },
                category:{
                    required:true,
                },
                discription:{
                    required:true,
                },
                price:{
                    required:true,
                    number:true,
                    min:1,
                },

                quantity:{
                    required:true,
                    number:true,
                    min:1,
                },
       
                colors:{
                    required:true,
                },
                size:{
                    required:true,
                }
              
            },
            messages: {
                title: {
                    required: "This field is required.",
                    minlength: "Please enter at least 5 characters."
                },
                photos: {
                    required: "Please select at least one image.",
                    // accept: "Only JPG, JPEG, and PNG file formats are allowed."
                },
                brand: {
                    required: "This field is required.",
                    
                },
                
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element); // Place the error message after the input element
            },
            highlight: function(element) {
                $(element).addClass('error'); // Add error class to the element
            },
            unhighlight: function(element) {
                $(element).removeClass('error'); // Remove error class from the element
            }
        });
    // $('#addProduct').validate({
    
    //         rules: {
    //         //     photos[]: {
    //         //         required: true,
    //         //         accept: "jpeg|png|jpec"
    //         //     },
                
    //         // },

    //         // messages: {
    //         //     photos: {
    //         //         required: "Please select at least one image.",
    //         //         accept: "Only JPG, JPEG, and PNG file formats are allowed."
    //         //     }
    //         // },
    //         errorPlacement: function(error, element) {
    //             error.insertAfter(element);
    //         }
    //     });

    // $('#photos').on('change',function){
    // $("#photos").rules("add", {
    //         accept: "jpg|jpeg|png",
    // }
    //         messages: {
    //             accept: "Only JPG, JPEG, and PNG formats are allowed."
    //         }
    //     });
        
var inpus=$('input[type=checkbox]');

let filesArray = [];
let selectedFiles = [];

   $('#photos').on('change',function(e){
    $('.col_show').html('');

   
    var files = $(this)[0].files;
    selectedFiles = Array.from($(this)[0].files);
        $(".col_show").empty();
        selectedFiles.forEach(function(file, index) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(`
                <div class="img_show" data-index="${index}">
                    <div class="inner">
                        <img src="${e.target.result}" alt="Product Photo">
                        <span class="x_btn closebtn"></span>
                    </div>
                </div>
            `).appendTo(".col_show");
        };
        reader.readAsDataURL(file);
    });
    })
    // filesArray = Array.from(this.files);

    // let formData = new FormData();
    //     let files = $('#photos')[0].files; // Access the file input element
        
    //     // Append each file to the FormData object
    //     for (let i = 0; i < files.length; i++) {
    //         formData.append('photos[]', files[i]);
    //     }
    //     formData.append('_token', $('input[name="_token"]').val());

    //                 $.ajax({
    //                     url: "{{ route('user.storeProductImages') }}",
    //                     type: 'POST',
    //                     data: formData,
    //                     processData: false,
    //                     cache: false,
    //                     contentType: false,
    //                     success: function(response) {
    //                      $('#photoerrorMessages').html('');

    //                      $.each(response, function(key, value) {
    //                     // $('#errorMessages').append('<p>' + value[0] + '</p>');
    //                     // console.log(key+" "+value);
    //                                        let fileBlock = `
    //                            <div class="img_show">
    //                                 <div class="inner">
    //                                   <img src="${value.path}" alt="Product Photo">
    //                                     <span class="x_btn " id="clossbtn" data-id="${value.id}" ></span>
    //                                 </div>
    //                              </div>
    //         `

          
  
 
        
      
    





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
                <div class="img_show" data-index="${index}">
                    <div class="inner">
                        <img src="${e.target.result}" alt="Product Photo">
                        <span class="x_btn closebtn"></span>
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

$(document).on('submit','#addProduct',function(e){
    e.preventDefault();
    // console.log("hello");
    let form=$(this)[0];

  
    

    let formData = new FormData(form);

        
               

                    console.log(formData);

                    $.ajax({
                        url: "{{ route('user.storeproduct') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function(response) {
                         $('#errorMessages').html('');

                            // console.log(response.success)
                            if(response.success){
                                window.location.href = response.redirect_url;
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
                    })
})


$('#colorPicker').on('change', function() {
       
        let color = $(this).val();
    
    // Create a new color block
    let colorBlock = `
    <div class="outer_blk_color">
        <!-- Selected colors will be appended here -->
        <div class="color_blk" style="background-color:${color};">
            <span class="x_btn" onclick="removeColor(this)"></span>
        </div>
        <input type="hidden" name="colors[]" value="${color}">
    </div>`;

    // Append the color block to the container
    $('#colorContainer').append(colorBlock);
    });




    

});

// Function to remove a color block
function removeColor(element) {
    // $(element).parent('.color_blk').remove();
    $(element).closest('.outer_blk_color').remove();
}
// onclick="takeSize(this)"


// function takeSize(element) {
//    console.log($(element).val())
// }


$(document).ready(function() {
    $('.lbl_btn label').on('click', function() {
        console.log('hi')
        //  const checkbox = $(this).prev('input[type="checkbox"]').parent();
        
        const checkbox = $(this).parent();
        if(checkbox.hasClass('active')){
            checkbox.removeClass('active');
        }else{
            checkbox.addClass('active')
        }

        //  checkbox.prop('checked', !checkbox.prop('checked')); // Toggle checkbox state
        // console.log(checkbox)
        // if(checkbox.attr('checked',true)){
        //     checkbox.attr('checked',false)
        // }else{
        //     checkbox.attr('checked',true)

        // }
        // if (checkbox.is(':checked')) {
        //     $(this).addClass('active');
        // } else {
        //     $(this).removeClass('active');
        // }
    });
});


// {{-- action="/store_product" method="POST" enctype="multipart/form-data" --}}
</script>

@endsection
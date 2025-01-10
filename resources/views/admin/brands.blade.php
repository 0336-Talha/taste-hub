@extends('admin.layouts.layoutsHome.app')

@section('content')
<div class="main p-3">
        
    <h1 style="text-align: center;">Brands Manager</h1>

    <button class="btn btn-primary mb-3" id="addBrand" >Add Brand</button>

    
    
            <div class="container">
                <div id="brand-container"></div>
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
$(document).ready(function(){
    
    function getBrands(){
        $.ajax({
        type:"GET",
        url:"{{route('admin.Brand')}}",
        success: function(brand) {
    // Select the container where the table will be appended
    let brandContainer = $('#brand-container');
    brandContainer.empty();  // Clear any existing content

    // Start building the table structure
    let table = `
        <div>
            <h5>Brands Table</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
    `;

    // Loop through the brand data to populate the table rows
    brand.forEach(function(data, index) {
        // Use template literals to dynamically include the image URL
        //  let img = `{{ asset('${data.image}') }}`.replace('${data.image}', data.image);
        // let img=`/${data.image}`;

        let img ="{{asset('')}}"+data.image;


        // Append each row to the table
        table += `
            <tr>
                <td>${index + 1}</td>
                <td id="name">${data.name}</td>
                <td><img src="${img}" id="Oldimage" style="height:100px; width:100px"></td>
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
    brandContainer.append(table);
},
        error:function(error){
            console.log(error);
        }
        })
    }

    getBrands();

    $('#addBrand').on('click',function(){
    $('#modalHeading').html('Add A Brand');
    let formHtml = `
        <form id="brandForm">

            <div class="form-group">
                <label for="bname">Brand Name</label>
                <input type="text" class="form-control" id="bname" name="bname" required>
                <p class="text-danger" id="error"></p>
            </div>
            <div class="form-group">
                <label for="image">Add Brand Logo </label>
                <input type="file" name="image" id="bImage">
                <img src="{{asset('noimage.jpg')}}" alt="" id="bSrc" style="height: 60px; width:60px">

            
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        
        </form>
    `;
    $('.modal-body').html(formHtml);
    $('#ajaxModel').modal('show');


    })


    $(document).on('submit','#brandForm',function(e){
    e.preventDefault();
    let form=$(this).html();
    // console.log(form);
    var formData = new FormData();
    let name = $("input[name=bname]").val();
    let id = $("input[name=id]").val();
    if(typeof id !== "undefined"){
        formData.append('id',id);
    }

    let oldimage = $("input[name=oldimage]").val();
    var url =  oldimage.split( '/' );
    // console.log(url[3]+"/"+url[4]);
    oldimage=url[3]+"/"+url[4];

    if(typeof oldimage !== "undefined"){
    formData.append('oldimage',oldimage);
    }

    let _token = $('meta[name="csrf-token"]').attr('content');
    var photo = $('#bImage').prop('files')[0];   

    formData.append('photo', photo);
    formData.append('_token', _token);
    formData.append('name', name);


    $.ajax({
        url: '{{route('admin.storeBrand')}}',
            type: 'POST',
            contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            success: (response) => {
                // success
                console.log(response);
                $('#ajaxModel').modal('hide');
                 getBrands();
            },
            error: (response) => {
        
        $('#error').html(error.responseJSON.message);

            }
    });
    
    });



    $('#brand-container').on('click','#edit',function(){
        let id = $(this).attr("data-id");
        let img=$(this).parent().prev().children('#Oldimage');
        let name=$(this).parent().parent().children('#name').text();
        // console.log(name.text());

        // console.log(img)
        // console.log(img.attr('src'));
        let oldimage=img.attr('src');
    $('#modalHeading').html('Edit Brand');

    let formHtml = `
        <form id="brandForm">
            <input type="hidden" name="id" value="${id}" />
            <input type="hidden" name="oldimage" value="${oldimage}" />


            <div class="form-group">
                <label for="bname">Brand Name</label>
                <input type="text" class="form-control" id="bname" value="${name}" name="bname" required>
                <p class="text-danger" id="error"></p>
            </div>
            <div class="form-group">
                <label for="image">Add Brand Logo </label>
                <input type="file" name="image" id="bImage">
                <img src="${oldimage}" alt="" id="bSrc" style="height: 60px; width:60px">

            
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        
        </form>
    `;
    $('.modal-body').html(formHtml);
    $('#ajaxModel').modal('show');


    })

    function readURL( input , imageTagId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
  
            reader.onload = function(e) {
                $('#' + imageTagId).attr('src', e.target.result);
            }
  
            reader.readAsDataURL(input.files[0]);
        }
    }
   
  
    $(document).on("change","#bImage",function() {
        readURL(this, 'bSrc');
        // console.log('hii')
    });


    $(document).on('click',"#btnClose",function(){
    $('#ajaxModel').modal('hide');

    })


})
</script>
@endsection
$(document).ready(function(){
    
    function getCategory(){
        $.ajax({
        type:"GET",
        url:"/admin/category",
        success:function(data){
            let categoriesContainer = $('#categories-container');
                    categoriesContainer.empty();

                    data.forEach(function(data) {

                        let table = `
                        <div>
                        <h5 id="mName" data-name=${data.name}>${data.name}</h5>
                                <div>
                                    <button  class="btn btn-info" data-id=${data.m_id} id="mEdit" >Edit</button>
                                    <button class="btn btn-danger" data-id=${data.m_id} id="mDelete">Delete</button>
                                    </div>
                                     <table class="table table-bordered">
                                         <thead>
                                             <tr>
                                                 <th>ID</th>
                                                 <th>Name</th>
                                                 <th>Operations</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                            </div>`;
                            let i=1;
                        data.sub_categories.forEach(function(subCategory) {
                            table += `<tr>
                                        <td>${i}</td>
                                        <td id="subName">${subCategory.name}</td>
                                        <td>
                                            <button  class="btn btn-info" data-id=${subCategory.sub_id} id="subEdit" >Edit</button>
                                    <button class="btn btn-danger" data-id=${subCategory.sub_id} id="subDelete">subDelete</button>
                                            </td>
                                      </tr>`;
                            i++;
                        });
                        table += `</tbody></table>`;
                        categoriesContainer.append(table);
                                         });
                        
             console.log(data);
            // console.log(data.main_category.name);
        }
        })
    }

    // ajaxModel

    getCategory();

$('#addMain').click(function(){
    $('#modalHeading').html('Add Main Category');

    let formHtml = `
        <form id="mainCategoryForm">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
                <p class="text-danger" id="error"></p>
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        
        </form>
    `;

    $('.modal-body').html(formHtml);
    $('#ajaxModel').modal('show');
    

})

$('#btnClose').click(function(){
$('#ajaxModel').modal('hide');
// console.log('hello');
})

$(document).on('submit', '#mainCategoryForm', function(e) {
    e.preventDefault();
    let form=$(this).html();
    // console.log(form);
    var formData = $(this).serialize(); 
    $.ajax({
        url:"{{route('admin.storeMainCategory')}}",
        method:"POST",
        data:formData,
        success:function(response){
            // console.log(response)
            // console.log(response);
        $('#ajaxModel').modal('hide');
        getCategory();


        },
        error:function(error){
        //  console.log(error.responseJSON.message)
        $('#error').html(error.responseJSON.message);
        },

    })
})


$(document).on('click', '#mEdit', function(e) {
    let mid = $(this).attr("data-id");
    console.log(mid);
    // let name=$('#mName').text();
    // let name=$(this).parent().parent().$("first-child");
    let name = $(this).closest('div').prev('h5').text(); 
    // let name=$(this)

    console.log(name)

    $('#modalHeading').html('Edit Main Category');

    let formHtml = `
        <form id="mainCategoryForm">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="mid" value="${mid}"/>


            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value=${name} required>
                <p class="text-danger" id="error"></p>
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        
        </form>
    `;

    $('.modal-body').html(formHtml);
    $('#ajaxModel').modal('show');
});


$(document).on('click', '#mDelete', function(e) {
    let mid = $(this).attr("data-id");
    console.log(mid);
    let con=confirm('Are You Sure!!!!! ?')
    
    if(con){

        $.ajax({
                    // /categories/delete/{category}
                    
                    url: `/admin/category/delete/${mid}`,
                    method: 'GET',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // console.log('success')
                          getCategory();


                        }
                    },
                    error: function(error) {
                        console.error('There was an error deleting the category!', error);
                    }
                });
    }


});


$('#addSub').click(function(){
    $('#modalHeading').html('Add Sub Category');

     // Fetch Main Categories via AJAX

     $.ajax({
        url: "{{ route('admin.getMainCategory') }}", // Adjust this route as necessary
        method: 'GET',
        success: function(response) {
            // console.log(response) //colection 
            let options = '';
            $.each(response, function(index, category) {
                // console.log(category.m_id)
                // console.log(category.name)
                options += `<option value="${category.m_id}">${category.name}</option>`; //select name store id
            })
            let formHtml = `
                <form id="subCategoryForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <label for="main_category_id">Main Category</label>
                        <select class="form-control" id="main_category_id" name="main_category_id" required>
                            ${options}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category_name">Sub Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                    </div>
                    <p class="text-danger" id="subError"></p>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                
            </form>

                    `;
             

                    $('.modal-body').html(formHtml);
            $('#ajaxModel').modal('show');
        },
        error: function(error) {
            console.log("Error fetching categories:", error);
        }

     })
            });

            $(document).on('submit', '#subCategoryForm', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
        url: "{{ route('admin.storeSubCategory') }}", // Adjust this route as necessary
        method: 'POST',
        data: formData,
        success: function(response) {
            console.log('response');

            if(response.status==422){
            $('#subError').html(response.error);
            }else{
                $('#ajaxModel').modal('hide');
                 getCategory();

            }

        },
        error: function(error) {
            console.log(error);
            alert('An error occurred.');
        }
    });

            });




            $(document).on('click', '#subEdit', function(e) {
    $('#modalHeading').html('Edit Sub Category');

            let subid = $(this).attr("data-id");
            console.log(subid);
            // console.log($(this).parent().parent().parent().parent().parent().children('#mName').text())
            let main=$(this).parent().parent().parent().parent().parent().children('#mName').text();
            let val=$(this).parent().parent().children('#subName').text();
            // console.log(val)
            $.ajax({
                 url: "{{ route('admin.getMainCategory') }}", // Adjust this route as necessary
        method: 'GET',
        success: function(response) {
            // console.log(response) //colection 
            let options = '';
            $.each(response, function(index, category) {
                // console.log(category.m_id)
                // console.log(category.name)
                let selected = category.name.trim() === main.trim() ? 'selected' : '';
                options += `<option value="${category.m_id}" ${selected}>${category.name}</option>`; //select name store id
            })
            let formHtml = `
                <form id="subCategoryForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="sub_id"  value="${subid}" />

                    <div class="form-group">
                        <label for="main_category_id">Main Category</label>
                        <select class="form-control" id="main_category_id" name="main_category_id" required>
                            ${options}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category_name">Sub Category Name</label>
                        <input type="text" class="form-control" id="category_name" value="${val}" name="category_name" required>
                    </div>
                    <p class="text-danger" id="subError"></p>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                
            </form>

                    `;
             

                    $('.modal-body').html(formHtml);
            $('#ajaxModel').modal('show');
        },
        error: function(error) {
            console.log("Error fetching categories:", error);
        }

     })

            })


        

  
    
            $(document).on('click', '#subDelete', function(e) {
        let subid = $(this).attr("data-id");
     console.log(subid);
        let con=confirm('Are You Sure ?')
    
    if(con){

        $.ajax({
                    // /categories/delete/{category}
                    
                    url: `/admin/subcategory/delete/${subid}`,
                    method: 'GET',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // console.log('success')
                          getCategory();


                        }
                    },
                    error: function(error) {
                        console.error('There was an error deleting the category!', error);
                    }
                });
    }


});



});
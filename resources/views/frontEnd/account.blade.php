@extends('frontEnd.layout.site-master')

@section('content')

<section id="account">
    <div class="contain sm">
        <div class="pro_blk">
            <div class="ico fill round">
                {{-- <img src="{{ asset('assets/images/users/01.webp')}}" alt=""> --}}
                <img id="upPhoto" src="{{ $account['photo'] == null ? asset('/noimage.jpg') : asset($account['photo'])}}" alt="">

            </div>
            <div class="txt">
                <h2><span>Welcome,</span>{{Auth::user()->name}}!</h2>
                <p>Nice to see you again.</p>
            
            </div>
        </div>
        <div class="pt-5"></div>
        <form id="accountForm">
            @csrf
            <div class="blk">
                <h4 class="mb-4">Personal information</h4>
                {{-- <p>hi {{$account['birthdate'] == null ? "" : $account['birthdate']}}</p> --}}

                <p>{{$account['birthdate']}}</p>
                <div class="dp_blk">
                    <div class="ico fill round">
                        <img id="photosrc" src="{{ $account['photo'] == null ? asset('/noimage.jpg') : asset($account['photo'])}}" alt="">
                    </div>
                    <div class="txt">
                        {{-- <div class="btn_blk"> --}}
                        <div>

                            <button type="button" class="change_photo_btn">Change Photo</button>
                            <input type="file" name="photo" id="photo">
                            <p id="photoerror" class="text-danger"></p>
                        </div>
                        <div class="pt-4"></div>
                        <div>Acceptable only jpg, png</div>
                        <div>The maximum file size is 500 kb and the minimum size is 80 kb.</div>
                    </div>
                </div>
                <div class="form_row row">
                    <div class="col-lg-4 col-12">
                        <h6>First Name</h6>
                        <div class="form_blk">
                            <input type="text" name="fname" id="fname" value="{{$firstName}}" required class="input" placeholder="eg: John" value="Jennifer">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <h6>Last Name</h6>
                        <div class="form_blk">
                            <input type="text" name="lname" id="lname" class="input" required placeholder="eg: Wick" value="{{$lastName}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <h6>Phone Number</h6>
                        <div class="form_blk">
                            <input type="text" name="number" id="number" class="input" required placeholder="eg: +92300 0000 000" value="{{Auth::user()->number}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <h6>Email Address</h6>
                        <div class="form_blk">
                            <input type="text" id="email" name="email" class="input" required placeholder="eg: sample@gmail.com" value="{{Auth::user()->email}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <h6>Date of Birth</h6>
                        <div class="form_blk">
                            <input type="date" name="date" id="date" value="{{ $account['birthdate'] == null ? "" : $account['birthdate'] }}" class="input" placeholder="eg: 01-01-1998">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <h6>Gender</h6>
                        <div class="form_blk">
                            <select name="gender" id="gender" class="input">
                                <option value="">Select</option>
                                <option value="male" {{ $account['gender'] == 
                                'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $account['gender'] == 
                                'female' ? 'selected' : '' }}>Female</option>
                                <option value="others" {{ $account['gender'] == 
                                'others' ? 'selected' : '' }}>Others</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr class="my-5">
                <h4 class="mb-4">Address information</h4>
                <div class="form_row row">
                    <div class="col-lg-4 col-12">
                        <h6>Country</h6>
                        <div class="form_blk">
                            <select name="country" id="country" class="input">
                                <option value="">Select</option>
                                @forEach($country as $country)
                                
                                <option value="{{$country['id']}}" {{$country['id'] == $account['country_id'] ? "selected" : ''}}>{{$country['name']}}</option>
                                
                                @endforeach
                    
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <h6>State</h6>
                        <div class="form_blk">
                            
                            <select name="state" id="state" class="input">


                                <option value="{{ $account['state_id'] == null ? "" : $account['state_id']}}">Select</option>
                                {{-- <option  hidden></option> --}}

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <h6>City</h6>
                        <div class="form_blk">
                            <input type="text" name="city" id="city" class="input" placeholder="eg: California" value="{{ $account['city'] == null ? "" : $account['city'] }}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <h6>Zip Code</h6>
                        <div class="form_blk">
                            <input type="text" id="zip" name="zip"  class="input" placeholder="eg: BL0 0WY" value="{{ $account['zip'] == null ? "" : $account['zip'] }}">
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <h6>Address</h6>
                        <div class="form_blk">
                            <input type="text" id="address" name="address" class="input" placeholder="eg: 123 Main Street, California" value="{{ $account['address'] == null ? "" : $account['address'] }}">
                        </div>
                    </div>
                </div>
                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong> Your form has been submitted successfully.
                </div>
                <div class="btn_blk justify-content-center mt-5">
                    <button type="submit" id="submit" disabled class="site_btn px">Save</button>
                </div>
            </div>
        </form>
        <div class="pt-5"></div>
        <form id="passwordForm">
            @csrf
            <div class="blk">
                <h4 class="mb-4">Change Password</h4>
                <div class="form_row row">
                    <div class="col-lg-4 col-12">
                        <div class="form_blk"><input type="password" name="current_password" id="current_password" class="input" placeholder="Current password"></div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="form_blk"><input type="password" name="new_password" id="new_password" class="input" placeholder="New password"></div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="form_blk"><input type="password" name="new_password_confirmation" id="new_password_confirmation" class="input" placeholder="Confirm new password"></div>
                    </div>
                </div>
                <p class="text-danger" id="new_password_error"></p> 
                <div id="successAlert1" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong> Your Password has been changed Successfully!
                </div>
                <div class="btn_blk justify-content-center mt-5">
                    <button type="submit" class="site_btn">Change Password</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- account -->

@endsection

@section('script')
<script>
    $(document).ready(function(){
        // $('#storeAccount').h('Your Info is Stored Successfully');
    
        // $('#submit').attr("disabled",true);
        // <option value="{{$country['id']}}">{{$country['name']}}</option>
        function getState(){
            let id=$('#country').val();
            let opt=$('#state');
            let opti=$('#state').val();
            // console.log(opti)
            // console.log($id);

            let options = '';
            $.ajax({
                url: `/states/${id}`,
                 method: 'GET',
                 data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        // opt.empty();
                                
                        // opt.append('<option value="">Select</option>');
                      
                        $.each(response.state, function(index, state) {
                            // console.log(state.name)

                         options+=`<option value="${state.id}" ${opti == state.id ? 'selected' : ''}> ${state.name}</option>`


                        })
                        opt.append(options);

                    },
                    error: function(error){
                        console.log(error);
                    }
                })

        }
        getState();
        $(document).on('change','#country',function(){
            let id=$(this).val();
            // console.log(id);
            let opt=$('#state');
            

            // console.log(opt)
            let options = '';
            $.ajax({
                url: `/states/${id}`,
                 method: 'GET',
                 data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        opt.empty();
                                
                                opt.append('<option value="">Select</option>');
                      
                        $.each(response.state, function(index, state) {
                            // console.log(state.name)
                         options+=`<option value="${state.id}">${state.name}</option>`


                        })
                        opt.append(options);

                    },
                    error: function(error){
                        console.log(error);
                    }

        })
            
            
            

        });
        $(document).on('change keyup','#accountForm',function(e){
        $('#submit').attr("disabled",false);

            
        })



        $(document).on('submit','#accountForm',function(e){
            e.preventDefault();
            let phsrc=$('#photosrc').attr('src');
        
        $('#submit').attr("disabled",true);
        

            // console.log('hi');
            let form=$(this)[0];
        // console.log(form);
    var formData = new FormData(form); 
    //  var photo = $('#photo').prop('files')[0];   
    // formData.append(photo);
    // for (var pair of formData.entries()) {
    //     console.log(pair[0]+ ': ' + pair[1]); 
    // }

    $.ajax({
        url: '{{route('user.accountStore')}}',
            type: 'POST',
            contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            success: function(response){
                // success
                console.log(response);
                $('#photoerror').html('')
              
                $('#successAlert').show();
                let up=$('#upPhoto').attr('src',phsrc);

    // Automatically hide the alert after 5 seconds
        setTimeout(function() {
        $('#successAlert').hide();
        }, 5000);

        //pic ko change

              
              
            },
            error: function(errors){
                $(window).scrollTop(0);
                $('#photoerror').html('YOU Have Not Reads The Photo instructions')
                // $('#photoerror').focus();
                $('#photoerror').focus();
            }
           
    });
            



        });


        function readURL( input , imageTagId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
  
            reader.onload = function(e) {
                $('#' + imageTagId).attr('src', e.target.result);
            }
  
            reader.readAsDataURL(input.files[0]);
        }
    }
   
  
    $(document).on("change","#photo",function() {
        readURL(this, 'photosrc');
        // console.log('hii')
    });


    $(document).on('submit','#passwordForm',function(e){
        e.preventDefault();

        // accountPassword
        let form=$(this)[0];
        // console.log(form);
    var formData = new FormData(form); 

    $.ajax({
        url: '{{route('user.accountPassword')}}',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            success: function(response){
                // success
                // console.log(response.error);
                if(response.error){
                 $('#new_password_error').text(response.error);
                }else{
                 $('#new_password_error').text("");

                    $('#successAlert1').show();
                    $('#passwordForm').find("input[type=password]").val("");
               

             // Automatically hide the alert after 5 seconds
             setTimeout(function() {
                $('#successAlert1').hide();
                }, 5000);

                }
               
              
              
            },
            error: function(xhr){
                // let error =errors.responseJSON.errors;
                //  console.log(error)

                if (xhr.responseJSON) {
                 let error =xhr.responseJSON.errors;
                  console.log(error)
            
            // Display the error messages
            if (error.new_password) {
                 $('#new_password_error').text(error.new_password[0]);
              
            }

            // You can add more error handling for other fields if necessary
        }
            }
           
    });



    })

    })
</script>
@endsection
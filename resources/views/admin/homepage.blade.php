@extends('admin.layouts.layoutsHome.app')

@section('content')



<div class="main">
  <h1 class="text-center" style="font-size: 40px">Home Page</h1>
  <div class="row justify-content-center">
    <div class="col-sm-7 mt-2">
  
  <form action="{{route('admin.storepage')}}" enctype="multipart/form-data" id="homeForm" method="POST">
     {{-- 1st --}}
   <h1 class="mb-1">1st view</h1>
    <p>Design Heading</p>
    @csrf
    <textarea name="editor1"  id="editor1"  class="form-control"></textarea>
    
    <p class="mt-3" >Paragraph</p>

    <textarea name="editor2"  id="editor2"  class="form-control"></textarea>
   
    
    <div style="display: flex; justify-content:flex; gap:10px">
    <div>
    <p class="mt-3" >Button Text</p>
  
    <input type="text"  style="width: 100%" id="btn1txt"  placeholder="enter text" name="btn1txt">
  </div>
  <div>
    <p class="mt-3" >Button Text 2</p>
  
    <input type="text"  style="width: 100%" id="btn2txt"  placeholder="enter text" name="btn2txt">
  </div>
  <div>
    <input type="hidden"  name="oldimage1" id="oldimage1">
    <p class="mt-3" >Image</p>
    <input type="file" name="image1"  id="image1">
  </div>
  <div style="margin-top:30px">
    <img src="{{asset('noimage.jpg')}}" id="image1tag" style="width: 80px; height:80px" alt="">
  </div>
</div>
<hr>
{{-- 2nd --}}
<h1>Second Scroll View</h1>

<p class="mt-3" >Heading</p>

<input type="text"  style="width: 100%" id="heading1"   placeholder="enter lines" name="heading1">
<p class="mt-3" >Paragraph</p>

{{-- <textarea type="text"  style="width: 100%" id="para2"  placeholder="enter lines" name="para2"></textarea> --}}

<textarea name="editor3"  id="editor3"  class="form-control"></textarea>

    <hr>
    {{-- 3rd --}}
    <h1>third Scroll View</h1>
    <p>Designed Heading</p>
    {{-- <input type="text" name="heading2" id="heading2"> --}}
<input type="text"  style="width: 100%" id="heading2"   placeholder="enter lines" name="heading2">

    <p>Paragraph</p>

    <textarea name="editor4" id="editor4" class="form-control"></textarea>


  {{-- <textarea type="text" id="para3" style="width: 100%"   placeholder="enter lines" name="para3"></textarea> --}}


<hr>
{{-- 4th --}}
<h1>4th Scroll View</h1>
<p class="mt-3" >Heading</p>

<input type="text" name="heading3" id="heading3" style="width: 100%"   placeholder="enter lines" >

<p>Paragraph</p>

{{-- <textarea type="text" id="para4" style="width: 100%"   placeholder="enter lines" name="para4"></textarea> --}}
<textarea name="editor5" id="editor5" class="form-control"></textarea>



<div style="display: flex; justify-content:flex; gap:10px">
  <div>
    <p class="mt-3" >Heading</p>

    <input type="text" name="heading4" id="heading4" style="width: 100%"   placeholder="enter lines" >
    
    <p>Paragraph</p>
    
    {{-- <textarea type="text" id="para4" style="width: 100%"   placeholder="enter lines" name="para4"></textarea> --}}
    <textarea name="editor6" id="editor6" class="form-control"></textarea>

</div>

<div>
  <input type="hidden"  name="oldimage2" id="oldimage2">
  <p class="mt-3" >Image</p>
  <input type="file" name="image2"  id="image2">
</div>
<div style="margin-top:30px">
  <img src="{{asset('noimage.jpg')}}" id="image2tag" style="width: 80px; height:80px" alt="">
</div>
</div>

<div style="display: flex; justify-content:flex; gap:10px">
  <div>
    <p class="mt-3" >Heading</p>

    <input type="text" name="heading5" id="heading5" style="width: 100%"   placeholder="enter lines" >
    
    <p>Paragraph</p>
    
    {{-- <textarea type="text" id="para4" style="width: 100%"   placeholder="enter lines" name="para4"></textarea>
     --}}
<textarea name="editor7" id="editor7" class="form-control"></textarea>

</div>

<div>
  <input type="hidden"  name="oldimage3" id="oldimage3">
  <p class="mt-3" >Image</p>
  <input type="file" name="image3"  id="image3">
</div>
<div style="margin-top:30px">
  <img src="{{asset('noimage.jpg')}}" id="image3tag" style="width: 80px; height:80px" alt="">
</div>
</div>

<div style="display: flex; justify-content:flex; gap:10px">
  <div>
    <p class="mt-3" >Heading</p>

    <input type="text" name="heading6" id="heading6" style="width: 100%"   placeholder="enter lines" >
    
    <p>Paragraph</p>
    
    {{-- <textarea type="text" id="para4" style="width: 100%"   placeholder="enter lines" name="para4"></textarea>
     --}}
<textarea name="editor8" id="editor8" class="form-control"></textarea>

</div>

<div>
  <input type="hidden"  name="oldimage4" id="oldimage4">
  <p class="mt-3" >Image</p>
  <input type="file" name="image4"  id="image4">
</div>
<div style="margin-top:30px">
  <img src="{{asset('noimage.jpg')}}" id="image4tag" style="width: 80px; height:80px" alt="">
</div>
</div>


<hr>
{{-- 5th --}}
<h1>5th Scroll View</h1>
<h3>heading</h3>
<input type="text" name="heading7" id="heading7" style="width: 100%"   placeholder="enter lines" >


    

    <p class="mt-3" >Paragraph</p>


<textarea name="editor9" id="editor9"   class="form-control"></textarea>

    


<hr>
{{-- 6th --}}
<h1>6th Scroll View</h1>
<p class="mt-3" >Heading</p>

<input type="text"  style="width: 100%"  id="heading8"  placeholder="enter lines" name="heading8">

<hr>
{{-- 7th --}}

<h1>7th Scroll View</h1>
<p>heading</p>
<input type="text"  style="width: 100%"  id="heading9"  placeholder="enter lines" name="heading9">
<p>Paragraph</p>
<textarea name="editor10" id="editor10"   class="form-control"></textarea>
    
  
<hr>

    <button class="btn btn-success" type="submit">Submit</button>
</form>
</div>
  </div>
</div>
@endsection

@section('script')
<script>
  // esay bhjna
window.Laravel = {
  // csrfToken: '{{ csrf_token() }}',
  assetBaseUrl: '{{ URL::asset('') }}',
  EnvVariable: "{{ env('APP_URL') }}"
};

</script>
 <script  >
  
  CKEDITOR.replace( 'editor1',{
    height:50,
    
   } );
   CKEDITOR.replace( 'editor2',{
    height:50,
   } );

   CKEDITOR.replace( 'editor3',{
    height:100,
   } );
   CKEDITOR.replace( 'editor4',{
    height:100,
   } );

   CKEDITOR.replace( 'editor5',{
    height:100,
   } );

   CKEDITOR.replace( 'editor6',{
    height:100,
   } );
   CKEDITOR.replace( 'editor7',{
    height:100,
   } );

   CKEDITOR.replace( 'editor8',{
    height:100,
   } );

   CKEDITOR.replace( 'editor9',{
    height:100,
   } );

   CKEDITOR.replace( 'editor10',{
    height:100,
   } );
//  form1
   let editor1=document.querySelector('#editor1');
   let editor2=document.querySelector('#editor2');
   let btn1txt=document.querySelector('#btn1txt');
   let btn2txt=document.querySelector('#btn2txt');

   let image1=document.querySelector('#image1tag');
   let oldimage1=document.querySelector('#oldimage1');

  //  console.log(btn1txt)
//2nd 
let heading1=document.querySelector('#heading1');
let editor3=document.querySelector('#editor3');

   
//   3rd
let heading2=document.querySelector('#heading2');
let editor4=document.querySelector('#editor4');


let heading3=document.querySelector('#heading3');
let editor5=document.querySelector('#editor5');

let heading4=document.querySelector('#heading4');
let editor6=document.querySelector('#editor6');

let image2=document.querySelector('#image2tag');
let oldimage2=document.querySelector('#oldimage2');

let heading5=document.querySelector('#heading5');
let editor7=document.querySelector('#editor7');

let image3=document.querySelector('#image3tag');
let oldimage3=document.querySelector('#oldimage3');

let heading6=document.querySelector('#heading6');
let editor8=document.querySelector('#editor8');

let image4=document.querySelector('#image4tag');
let oldimage4=document.querySelector('#oldimage4');


let heading7=document.querySelector('#heading7');
let editor9=document.querySelector('#editor9');

let heading8=document.querySelector('#heading8');
let heading9=document.querySelector('#heading9');

let editor10=document.querySelector('#editor10');



   $(document).ready(function(){
     var assetBaseUrl = "{{ asset('') }}";
      //  var urlimage="{{env('APP_URL')}}"
       const urlimage = window.Laravel.EnvVariable;
      // const urlimage = window.location.hostname;

      // console.log(assetBaseUrl);
      // console.log(window.location.hostname)
      // const someEnvVariable = window.Laravel.someEnvVariable;
       $.ajax({
        type:"GET",
        url:"{{route('admin.homepage')}}",
        success:function(data){
             console.log(data);
             editor1.value=data.meta_data.editor1;
             editor2.value=data.meta_data.editor2;
             btn1txt.value=data.meta_data.btn1txt;
             btn2txt.value=data.meta_data.btn2txt;

             if(data.meta_data.image1 != undefined && data.meta_data.image1 != "" ){
               image1.src=assetBaseUrl+data.meta_data.image1;
               // image1.attr('src',data.meta_data.image1);
                oldimage1.value=data.meta_data.image1;
             }

            //  2nd

             heading1.value=data.meta_data.heading1
            editor3.value=data.meta_data.editor3


            heading2.value=data.meta_data.heading2
            editor4.value=data.meta_data.editor4


            
            heading3.value=data.meta_data.heading3
            editor5.value=data.meta_data.editor5

            heading4.value=data.meta_data.heading4
            editor6.value=data.meta_data.editor6
            if(data.meta_data.image2 != undefined && data.meta_data.image2 != "" ){
               image2.src=assetBaseUrl+data.meta_data.image2;
               // image1.attr('src',data.meta_data.image1);
                oldimage2.value=data.meta_data.image2;
             }

            heading5.value=data.meta_data.heading5
            if(data.meta_data.image3 != undefined && data.meta_data.image3 != "" ){
               image3.src=assetBaseUrl+data.meta_data.image3;
               // image1.attr('src',data.meta_data.image1);
                oldimage3.value=data.meta_data.image3;
             }
            editor7.value=data.meta_data.editor7

            heading6.value=data.meta_data.heading6
            if(data.meta_data.image4 != undefined && data.meta_data.image4 != "" ){
               image4.src=assetBaseUrl+data.meta_data.image4;
               // image1.attr('src',data.meta_data.image1);
                oldimage4.value=data.meta_data.image4;
             }
            editor8.value=data.meta_data.editor8
            // 3rd
            heading7.value=data.meta_data.heading7;
            editor9.value=data.meta_data.editor9;

            heading8.value=data.meta_data.heading8;
            heading9.value=data.meta_data.heading9;

            editor10.value=data.meta_data.editor10;


        }
    


      //   ------------------

      

   });

   // showing image.


   function readURL(input, imageTagId) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
              $('#' + imageTagId).attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#image1").change(function() {
      readURL(this, 'image1tag');
  });

  $("#image2").change(function() {
      readURL(this, 'image2tag');
  });

  $("#image3").change(function() {
   readURL(this, 'image3tag');
});

$("#image4").change(function() {
   readURL(this, 'image4tag');
});

   });


  //  $('#homeForm').on('submit', function(e) {
  //       e.preventDefault();
      
  //     })
  
  </script> 


@endsection
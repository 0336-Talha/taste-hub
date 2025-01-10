<?php
// if ($_SERVER["HTTP_HOST"] != "localhost") {
// 	function base_url()
// 	{
// 		return "https://www.herosolutions.com.pk/breera/tracksuit-f/";
// 	}
// } else {
// 	function base_url()
// 	{
// 		return "http://localhost/work/tracksuit-f/";
// 	}
// }
?>
<?php // $page = substr(basename($_SERVER['PHP_SELF']), 0, -4); ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Home — Tracksuit Company</title>

	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
<meta name="theme-color" content="#d3ad56" />

{{-- <meta name="description" content="Elevate Your Tracksuit Game with Exclusive Bidding!">
<meta property="og:type" content="website">
<meta property="og:url" content="/asset('/front/')index.php">
<meta property="og:title" content="Tracksuit Company">
<meta property="og:description" content="Elevate Your Tracksuit Game with Exclusive Bidding!">
<meta property="og:image" content="/asset('/front/')assets/images/thumbnail.webp">
<meta property="twitter:card" content="thumbnail">
<meta property="twitter:url" content="/asset('/front/')index.php">
<meta property="twitter:title" content="Tracksuit Company">
<meta property="twitter:description" content="Elevate Your Tracksuit Game with Exclusive Bidding!">
<meta property="twitter:image" content="/ asset('/front/')?>assets/images/thumbnail.webp"> --}}

<!-- Css Files -->
<link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('front/assets/css/slick.min.css')}}">

<link rel="stylesheet" href="{{asset('front/assets/css/fancybox.min.css')}}">


<link rel="stylesheet" href="{{asset('front/assets/scss/app.css?v=0.1')}}">
<link rel="stylesheet" href="{{asset('front/assets/css/jquery.rateyo.css')}}">





<!-- Favicon -->
<link type="image/png" rel="icon"  href="{{asset('front/assets/images/favicon.webp')}}">

<link rel="manifest" rel="icon"  href="{{asset('front/manifest.json')}}">





<!-- Include jQuery first -->

{{-- 
<!-- Include Slick Carousel CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

<!-- Include Slick Carousel JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> --}}

</head>
@include('frontEnd.layout.header');

@yield('styles')
<body>

	@yield('content')


@include('frontEnd.layout.footer')
	<!-- JS Files -->
	<!-- Include RateYo JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/rateyo@2.3.2/lib/jquery.rateyo.min.js"></script> --}}
<script src="<?= asset('/front')?>/assets/js/jquery.min.js"></script>
<script src="<?= asset('/front')?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= asset('/front')?>/assets/js/slick.min.js"></script>
<script src="<?= asset('/front')?>/assets/js/fancybox.min.js"></script>
<script src="<?= asset('/front')?>/assets/js/jquery.rateyo.js"></script>
{{-- <link rel="stylesheet" href="{{ asset('/front/assets/js/jquery.validate.min.js')}}"> --}}
<script src="{{ asset('/front/assets/js/jquery.validate.min.js') }}"></script>
 

<script src="https://js.stripe.com/v3/"></script>
<!-- Include Raty Plugin -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/raty/2.9.0/jquery.raty.min.js"></script>

{{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<script>

	var availableTags=[];
	$.ajax({
		method:"GET",
		url:'/searchProduct',
		
		success:function (response){
			console.log(response)
			startAutoComplete(response);
		}
	})
	function startAutoComplete(availableTags){
    $( "#search_product" ).autocomplete({
      source: availableTags
    });
}

  </script>

@yield('script')
</body>
</html>




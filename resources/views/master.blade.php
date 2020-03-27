<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="{{asset('')}}">  
	<title>Phụ Kiện Phong Phú </title>
	<link rel="icon" type="image/png" href="{{ asset('frontEnd/assets/dest/images/Shop.ico') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/font-Dosis.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/font-Sans.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/bootstrap_3.1.0.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/vendors/colorbox/example3/colorbox.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/rs-plugin/css/settings.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/rs-plugin/css/responsive.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/huong-style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/phong-style.css') }}">
	@yield('link')
</head>
<body>
	<button id="myBtnScroll" title="Go to top"><i class="fa fa-arrow-up"></i></button>
	<!-- Header -->
	@include('layouts.header')

	<!-- Content -->
	@yield('content') 

	<!-- Footer -->
	@include('layouts.footer')

	<!-- include js files -->
	<script src="{{ asset('frontEnd/assets/dest/js/jquery.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/js/jquery.zoom.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/js/jquery2.1.3.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/js/bootstrap_3.1.0.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/vendors/bxslider/jquery.bxslider.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/vendors/colorbox/jquery.colorbox-min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/vendors/animo/Animo.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/vendors/dug/dug.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/js/scripts.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/js/wow.min.js') }}"></script>
	<!--customjs-->
	<script src="{{ asset('frontEnd/assets/dest/js/custom2.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/js/phongCustom.js') }}"></script>
	<script>
			$(document).ready(function() {    
				$(window).scroll(function(){
					if($(this).scrollTop()>150){
						$('#myBtnScroll').css('display','block');
						$(".header-bottom").addClass('fixNav');

					}else{
						$('#myBtnScroll').css('display','none');
						$(".header-bottom").removeClass('fixNav');
					}
				});
			});
			$(document).ready(function(){
				$('#myBtnScroll').on('click',function(){
					 $('html, body').animate({
                    	scrollTop: $("body").offset().top}, 1000);
				});
			});
	</script>
	@yield('script') 
</body>
</html>

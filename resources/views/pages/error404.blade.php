<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>404 Not Found</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/bootstrap_3.1.0.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/error404.css') }}">

</head>
<body>
	<section class="page_404">
	<div class="container">
		<div class="row">	
		<div class="col-sm-12 ">
		<div class="col-sm-10 col-sm-offset-1  text-center">
		<div class="four_zero_four_bg">
			<h1 class="text-center">404</h1>
		
		
		</div>
		
		<div class="contant_box_404">
		<h3 class="h2">
		Look like you're lost
		</h3>
		
		<p>the page you are looking for not avaible!</p>
		
		<a href="{{ Route('home.index') }}" class="btn btn-success">Go to Home</a>
	    </div>
		</div>
		</div>
		</div>
	</div>
</section>
</body>
</html>
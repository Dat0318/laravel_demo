@extends('master')
@section('content')
	<div class="container">
		<div id="content" class="space-top-none">			
			<div class="space50">&nbsp;</div>
			<div class="row">
				<div class="notice-cart-null">
					<div class="img-checkout-success">
						<img src="frontEnd\assets\dest\images\checkoutSuccess.png">
					</div>
					<h5 class="title-checkout-success">Chúc Mừng Quý Khách Đã Đặt Hàng Thành Công</h5>
					<p>Vui lòng xác nhận lại thông tin qua email</p>
					<p>Mọi thắc mắc xin liên hệ hotline:<span style="color: red">0964 648 152</span></p>
					<div class="connect-home"> <a href="{{ Route('home.index') }}">TIẾP TỤC MUA HÀNG</a></div>
				</div>
			</div>
		</div>
	</div> <!-- #content -->
@endsection
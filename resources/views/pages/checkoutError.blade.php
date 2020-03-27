@extends('master')
@section('content')
	<div class="container">
		<div id="content" class="space-top-none">			
			<div class="space50">&nbsp;</div>
			<div class="row">
				<div class="notice-cart-null">
					<div class="img-checkout-success">
						<img src="frontEnd\assets\dest\images\cart-error.png">
					</div>
					<h5 class="title-checkout-error">Khách Hàng Đặt Hàng Không Thành Công</h5>
					<p>Khách hàng vui lòng quay lại tạo giỏ hàng mới.</p>
					<p>Mọi thắc mắc xin liên hệ hotline:<span style="color: red">0964 648 152</span></p>
					<div class="connect-home"> <a href="{{ Route('home.index') }}">QUAY LẠI MUA HÀNG</a></div>
				</div>
			</div>
		</div>
	</div> <!-- #content -->
@endsection
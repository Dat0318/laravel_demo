	@extends('master')
	@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Liên hệ</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{ Route('home.index') }}">Trang chủ</a> / <span>Liên hệ</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">			
			<div class="space50">&nbsp;</div>
			<div class="row">
				<div class="col-sm-8" >
					<div class="beta-map" style="border:2px solid #fcfcfc">		
						<div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.409772612195!2d105.78098151445377!3d20.976205094947357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acd2d89877d7%3A0xe55435164e9b4695!2zMTk3IFRy4bqnbiBQaMO6LCBQLiBWxINuIFF1w6FuLCBIw6AgxJDDtG5nLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1572859507365!5m2!1svi!2s"></iframe></div>
					</div>
				</div>
				<div class="col-sm-4" id="infoContact">
					<h2>Thông tin liên hệ</h2>
					<div class="space20">&nbsp;</div>

					<h6 class="contact-title">Địa Chỉ</h6>
					<p>
						Ngõ 197 Trần Phú, Văn Quán,Hà Đông, Hà Nội<br>
						Việt Nam
					</p>
					<div class="space20">&nbsp;</div>
					<h6 class="contact-title">Câu hỏi thắc mắc</h6>
					<p>
						Mọi thắc mắc vui lòng quý khách hàng gửi tới mail:<br>
						<i>pkdtPhongPhu@gmail.com</i>
					</p>
					<div class="space20">&nbsp;</div>
					<h6 class="contact-title">Nhân viên</h6>
					<p>
						Chúng tôi sẽ luôn tìm kiếm những nhân viên tiềm năng để phục vụ quý khách hàng<br>
						<i>hr@pkdtPhongPhu.com</i>
					</p>
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
	@endsection
@extends('master')

@section('link')
	@yield('linkAccount')
@endsection

@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Thông tin khách hàng</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{ Route('home.index') }}">Trang chủ</a> / <span>@yield('title')</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-3">
					<div class="media headAccount">
						<a class="pull-left" href="#">
							@if( $user->gender == 1)
							<img class="media-object imgUserAccount" src="frontEnd\assets\dest\images\comments\icon_men.png" alt="">
							@else
							<img class="media-object imgUserCmt" src="frontEnd\assets\dest\images\comments\icon_woman.png" alt="">
							@endif
						</a>
						<div class="media-body bodyAccount">
							<h4 class="media-heading"> Tài khoản của <br> {{ $user->name }}</h4>
						</div>
					</div>
					<div>
					<ul id="titleAsideMenu">Menu</ul>
					<ul class="aside-menu">
						<li><a href="{{ Route('home.account',$user->id) }}"><i class="fa fa-user"></i>Thông tin tài khoản</a></li>
						<li><a href="{{ Route('home.changePassword',$user->id) }}"><i class="fa fa-key"></i>Cập nhật mật khẩu</a></li>
						<li><a href="{{ Route('home.historyOrder',$user->id) }}"><i class="fa fa-home"></i>Lịch sử đơn hàng</a></li>
					</ul>
					</div>
				</div>
				<!-- Content -->
				@yield('contentAccount') 

			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection

@section('script')
	<script> 
		$(document).ready(function(){
			$('.contentAccount .form-block input').change(function(){
				$('#btnUpdateAccount').removeAttr('disabled');
			})
		});
	</script>
	@yield('scriptAccount')
@endsection
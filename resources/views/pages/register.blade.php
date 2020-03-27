	@extends('master')
	@section('content')	
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng ký</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{ Route('home.index') }}">Trang chủ</a> / <span>Đăng ký</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">		
			<form action="{{ Route('home.register') }}" method="post" class="beta-form-checkout">
				@csrf
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						@if(count($errors)>0)
		                    <div class="alert alert-danger alert-dismissible" role="alert">
		                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                    @foreach( $errors->all() as $key => $err )
		                        <strong>{{ ($key+1) }}.</strong>{{ $err }}<br>
		                    @endforeach
		                    </div>      
		                @endif

		                @if(session('notification'))
		                    <div class="alert alert-success alert-dismissible" role="alert">
		                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								{{ session('notification') }}
		                    </div>
		                @endif
						<h4>Đăng ký</h4>
						<div class="space20">&nbsp;</div>
						<div class="form-block">
							<label for="email">Địa chỉ Email <span style="color:red">(*)</span></label>
							<input type="email" id="email" name="txtEmail" value="{{ old('txtEmail')}}"placeholder="Nhập địa chỉ email..." required>
						</div>
						<div class="form-block">
							<label for="your_last_name">Họ tên <span style="color:red">(*)</span></label>
							<input type="text" id="your_last_name" name="txtFullName" value="{{ old('txtFullName')}}" placeholder="Nhập họ tên..." required>
						</div>
						<div class="form-block">
							<label for="adress">Địa chỉ</label>
							<input type="text" id="adress" name="txtAddress" placeholder="Nhập địa chỉ..."  value="{{ old('txtAddress')}}">
						</div>
						<div class="form-block">
							<label for="phone">Điện thoại</label>
							<input type="text" id="phone" name="txtPhone"  value="{{ old('txtPhone')}}">
						</div>
						<div class="form-block">
							<label for="pass">Mật khẩu <span style="color:red">(*)</span></label>
							<input type="password" id="password" name="txtPassword" class="inputPass" required>
						</div>
						<div class="form-block">
							<label for="pass">Nhập lại mật khẩu <span style="color:red">(*)</span></label>
							<input type="password" id="re_password" name="txtRePassword" class="inputPass" required>
						</div>
						<div class="form-block">
							    <label>Giới tính</label>
                                <label>
                                    <input name="rdoGender" value="1" checked="" type="radio">Nam
                                </label>
                                <label>
                                    <input name="rdoGender" value="0" type="radio">Nữ
                                </label>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary ml-29">Đăng ký</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
	@endsection
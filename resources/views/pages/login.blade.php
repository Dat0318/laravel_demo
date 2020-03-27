	@extends('master')
	@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng nhập</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{ Route('home.index') }}">Trang chủ</a> / <span>Đăng nhập</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">			
			<form action="{{ Route('home.login') }}" method="post" class="beta-form-checkout">
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
				            <div class="alert alert-danger alert-dismissible" role="alert">
				                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								{{ session('notification') }}
				            </div>
				        @endif

				        @if(session('noticeActive'))
				            <div class="alert alert-success alert-dismissible" role="alert">
				                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								{{ session('noticeActive') }}
				            </div>
				        @endif
				        
						<h4>Đăng nhập</h4>
						<div class="space20">&nbsp;</div>

						<input type="hidden" name="url" value="{{ url()->previous() }}" >
						<div class="form-block">
							<label for="email">Email <span style="color:red">(*)</span></label>
							<input type="email" id="email" name="txtEmail" required>
						</div>
						<div class="form-block">
							<label for="phone">Mật khẩu<span style="color:red">(*)</span></label>
							<input type="password" id="pass" name="password" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary ml-29">Đăng nhập</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
	@endsection
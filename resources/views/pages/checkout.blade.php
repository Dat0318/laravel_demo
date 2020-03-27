@extends('master')
@section('content')

	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đặt hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{ Route('home.index') }}">Trang chủ</a> / <span>Đặt hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
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
			
			<form action="{{ Route('home.checkout') }}" method="post" class="beta-form-checkout">
				@csrf
				<div class="row">
					<div class="col-sm-6">
						<h4>Đặt hàng</h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="name">Họ tên <span class="cl-red">(*)</span></label>
							<input type="hidden" name="customersId" value="{{isset($user)?$user->id:''}}">
							<input type="text" id="name" name="txtName" placeholder="Họ tên" value="{{isset($user)?$user->name:old('txtName')}}" required>
						</div>

						<div class="form-block">

							<label>Giới tính </label>
							
							@if(isset($user))
								<input id="gender" type="radio" class="input-radio" name="gender" value="1" 
								{{ ($user->gender == 1)?'checked':'' }} style="width: 10%"><span style="margin-right: 10%">Nam</span>
								<input id="gender" type="radio" class="input-radio" name="gender" value="0" 
								{{ ($user->gender == 0)?'checked':'' }} style="width: 10%"><span>Nữ</span>
							@else
								<input id="gender" type="radio" class="input-radio" name="gender" value="1" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
								<input id="gender" type="radio" class="input-radio" name="gender" value="0" style="width: 10%"><span>Nữ</span>
							@endif


						</div>

						<div class="form-block">
							<label for="email">Email <span class="cl-red">(*)</span></label>
							<input type="email" id="email" name="txtEmail" value="{{isset($user)?$user->email:old('txtEmail')}}" required placeholder="expample@gmail.com">
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ <span class="cl-red">(*)</span></label>
							<input type="text" id="adress" name="txtAddress" placeholder="Địa chỉ" value="{{isset($user)?$user->address:old('txtAddress')}}" required>
						</div>
						

						<div class="form-block">
							<label for="phone">Điện thoại <span class="cl-red">(*)</span></label>
							<input type="text" name="txtPhone" id="phone" value="{{isset($user)?$user->phone:old('txtPhone')}}" required>
						</div>
						
						<div class="form-block">
							<label for="notes">Ghi chú</label>
							<textarea id="notes" name="txtNote" value="old('txtNote')"></textarea>
						</div>
					</div>

					<?php 
						$cartProducts = Cart::Content();
						$subtotal = Cart::subtotal();
					?> 

					<div class="col-sm-6">
						<div class="your-order">
							<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
							<div class="your-order-body" style="padding: 0px 10px">
								<div class="your-order-item">
									<div>

									@foreach($cartProducts as $cartProduct  )
									<!--  one item	 -->
										<div class="media">
											<img width="25%" src="upload/products/{{ $cartProduct->options->image }}" alt="" class="pull-left">
											<div class="media-body">
												<p class="font-large">{{ $cartProduct->name }}</p>

												@foreach($categories as $item)
												@if( $cartProduct->options->cateId == $item->id )
												<span class="color-gray your-order-info">Thể loại:{{ $item->name }}</span>
												@endif
												@endforeach

												<span class="color-gray your-order-info">Qty: {{ $cartProduct->qty }}</span>
											</div>
										</div>
									<!-- end one item -->
									@endforeach
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
									<div class="pull-right"><h5 class="color-black">{{ rtrim(rtrim($subtotal,"0"),".") }} VNĐ</h5></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
							
							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio"  name="payment" value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
										</div>						
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio"name="payment" value="ATM" data-order_button_text="">
										<label for="payment_method_cheque">Chuyển khoản </label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											Chuyển tiền đến tài khoản sau:
											<br>- Số tài khoản: 123 456 789
											<br>- Chủ TK: Nguyễn A
											<br>- Ngân hàng ACB, Chi nhánh TPHCM
										</div>						
									</li>
									
								</ul>
							</div>

							<div class="text-center"><button type="submit" class="beta-btn primary" id="btnOrder">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
@section('script')
<script>
            $(document).ready(function(){
                $('#payment_method_bacs').change(function(){
                    if($(this).is(':checked')){
                        $('.payment_box.payment_method_bacs').css('display','block');
                        $('.payment_box.payment_method_cheque').css('display','none');
                    }
                });

                $('#payment_method_cheque').change(function(){
                    if($(this).is(':checked')){
                        $('.payment_box.payment_method_cheque').css('display','block');
                        $('.payment_box.payment_method_bacs').css('display','none');
                    }
                });
            })
	</script>
@endsection
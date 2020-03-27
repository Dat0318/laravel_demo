@extends('master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Thông tin giỏ hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{ Route('home.index') }}">Trang chủ</a> / <span>Thông tin giỏ hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
    <!-- Hiển thị cảnh báo hết hàng -->
    @if(session('warning'))
	<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: center;">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong><i class="fa fa-warning" style="font-size:20px;color:red"></i></strong> {{ session('warning') }}
	</div>
	@endif

	<div class="container">
		<div id="content">
			
			@if( count($cartProducts)!=0 )
				<div class="table-responsive">
					<!-- Shop Products Table -->
					<table class="shop_table beta-shopping-cart-table" cellspacing="0">
						<thead>
							<tr>
								<th class="product-name">Product</th>
								<th class="product-price">Price</th>
								<th class="product-status">Stock</th>
								<th class="product-quantity">Quantity</th>
								<th class="product-subtotal">Total</th>
								<th class="product-remove">Remove</th>
							</tr>
						</thead>
						<tbody>
							<?php $total = 0; ?>
							@foreach( $cartProducts as $cartProduct )
							<tr class="cart_item">
								<td class="product-name" >
									<div class="media">
										<a class="pull-left" href="{{ route('home.productDetail',$cartProduct->id)}}"><img src="upload/products/{{ $cartProduct->options->image }}" alt=""></a>
										<div class="media-body">
											<p class="font-large table-title">{{ $cartProduct->name }}</p>

											@foreach($categories as $item)
	                                        @if( $cartProduct->options->cateId == $item->id )			
											<p class="table-option">Thể loại:{{ $item->name }} </p>
											@endif
											@endforeach
											
										</div>
									</div>
								</td>

								<td class="product-price">
									<span class="amount">{{ number_format($cartProduct->price,'0','','.') }}</span>
								</td>

								<td class="product-status">
									<p><span>{{ $cartProduct->options->stockQty }}</span> sản phẩm có sẵn</p>
								</td>

								<td class="product-quantity">
								
								<div class="form-add-cart">
									<input type="hidden" value="{{ $cartProduct->rowId }}" name="rowId">	
									<div class="quantity">
									 <button class="minus-btn" name="button" mode="2">
								        <img src="frontEnd\assets\dest\images\minus.svg" alt="" />
								      </button>
								      <input class="inputQty" type="text" name="qty" min="1" value="{{ $cartProduct->qty }}" stockQty="{{ $cartProduct->options->stockQty }}" mode="2">
								      <button class="plus-btn" name="button">
								        <img src="frontEnd\assets\dest\images\plus.svg" alt="" />
								      </button>
								    </div>
								</div>
								
								</td>
								
								<?php $subTotal = ($cartProduct->qty)*($cartProduct->price); ?>

								<td class="product-subtotal">
									<span class="amount">{{ number_format($subTotal,'0','','.') }}</span>
								</td>

								<td class="product-remove">
									<a href="{{ Route('home.removeCart', $cartProduct->rowId) }}"
								 	style="display: none"> </a>
									<a class="remove" id="iconRemove"><i class="fa fa-trash-o"></i></a>
								</td>
							</tr>

							<?php  $total = $total+$subTotal; ?>

							@endforeach
						</tbody>

						<tfoot>
							<tr>
								<td colspan="6" class="actions">

									<div class="cart-totals pull-right">
										<div class="cart-totals-row"><span>Cart Total:</span> 
											<span>{{ number_format($total) }} </span>
										</div>
									</div>	
									
									<button type="submit" class="beta-btn primary" id="btnCheckout" name="proceed"><a id="linkCheckout" href="{{Route('home.checkout')}}">Đặt hàng </a></button>

									<div class="connect-home"> <a href="{{ Route('home.index') }}"> Đến trang chủ </a></div>

									<div class="clearfix"></div>
								</td>
							</tr>
						</tfoot>
					</table>
					<!-- End of Shop Table Products -->
				</div>
			@else
				<div class="notice-cart-null">
					<div class="img-null">
						<img src="frontEnd\assets\dest\images\null.png">
					</div>
					<h5>Không có sản phẩm nào trong giỏ hàng của bạn</h5>
					<div class="connect-home"> <a href="{{ Route('home.index') }}"> ĐẾN TRANG CHỦ PHỤ KIỆN PHONG PHÚ </a></div>
				</div>
			@endif

			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>

		</div> <!-- #content -->
	</div> <!-- .container -->

<div class="modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Xóa Sản Phẩm Trong Giỏ Hàng</h5>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc chắn xóa sản phẩm này không ?</p>

      </div>
      <div class="modal-footer">
      	<a href="" style="display: none"></a>
        <button type="button" class="btn btn-primary" id="btnAgree">
        Đồng Ý</button>
        <button type="button" class="btn btn-danger" id="closeConfirm">Thoát</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
	<script src="{{ asset('frontEnd/assets/dest/js/quantity.js') }}"></script>
	<script>
		$(document).ready(function(){
				$('.plus-btn').click(function(){
			  	var rowId = $(this).closest('div').prev('input').val();
			  	var qty =  parseInt($(this).prev('.inputQty').val());
			  	
			  	$.ajax({
				    type:"POST",
				    url: "home/updateCart",
				    data: { 
				    	"_token": "{{ csrf_token() }}",
				    	"rowId": rowId, 
				    	"qty": qty ,
				    },
				    success: function(data){
				      window.location.reload(); 
				    },
				    error: function(data){
					 console.log('Error:', data);
					}
			  	});
			});

			$('.minus-btn').click(function(){
			  	var rowId = $(this).closest('div').prev('input').val();
			  	var qty =  parseInt($(this).next('.inputQty').val());
			  	
			  	$.ajax({
				    type:"POST",
				    url: "home/updateCart",
				    data: { 
				    	"_token": "{{ csrf_token() }}",
				    	"rowId": rowId, 
				    	"qty": qty ,
				    },
				    success: function(data){
				      window.location.reload(); 
				    },
				    error: function(data){
					 console.log('Error:', data);
					}
			  	});
			});

			$('.inputQty').on('change',function(){
				var rowId = $(this).closest('div').prev('input').val();
			  	var qty =  $(this).val();
			  	
			  	$.ajax({
				    type:"POST",
				    url: "home/updateCart",
				    data: { 
				    	"_token": "{{ csrf_token() }}",
				    	"rowId": rowId, 
				    	"qty": qty ,
				    },
				    success: function(data){
				      window.location.reload(); 
				    },
				    error: function(data){
					 console.log('Error:', data);
					}
			  	});
			});

			// Xác nhận có xóa sản phẩm không
			$('.remove').click(function(){
				let url = $(this).prev('a').attr('href');
				$('.modal').css('display','block');
				$('#btnAgree').prev('a').attr('href',url);
			});

			$('#closeConfirm').click(function(){
				$('.modal').fadeOut(300);
			});

			$('#btnAgree').click(function(){
				let url = $(this).prev('a').attr('href');
				document.location.href=url;
			});
		});	
	</script>
	
@endsection
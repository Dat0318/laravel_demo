	@extends('master')
	@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm {{ $product->name }}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{ Route('home.index') }}">Trang chủ</a> / <span>Thông tin chi tiết sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<!-- Hiển thị cảnh báo hết hàng -->
    @if(session('warning'))
	<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: center;">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong><i class="fa fa-warning" style="font-size:20px;color:red"></i></strong>{{ session('warning') }}
	</div>
	@endif
	
	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">
	
					<div class="row">
						<div class="col-sm-4 img-product-detail">
							<div class="img-parent zoom" >
								<img src="upload/products/{{ $product->image }}" id="imgParent">
							</div>

							<div class="img-child">
								<img src="upload/products/{{ $product->image }}" class="child boder-child">
								@foreach($imagesProduct as $item)
								<img src="upload/products/{{ $item->image }}" class="child" alt="">
								@endforeach
							</div>
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title">{{ $product->name }}</p>
								<p class="single-item-price">
									@if($product->promotion_price == 0)
										<span class="flash-sale">{{ number_format($product->unit_price,'0','','.') }}₫</span>
									@else
										<span class="flash-del">{{ number_format($product->promotion_price,'0','','.')}}₫</span>
										<span class="flash-sale">{{ number_format($product->unit_price,'0','','.') }}₫</span>
									@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{ $product->description }}</p>
							</div>
							<div class="space20">&nbsp;</div>
			
							<p>Số Lượng: </p>
							{!! Form::open(['url'=>'home/shoppingCart','method'=>'POST']) !!}
								<input type="hidden" name="productId" value="{{$product->id}}">
								<div class="form-add-cart">
									<div class="quantity">
									 <button class="minus-btn" name="button" mode="1">
								        <img src="frontEnd\assets\dest\images\minus.svg" alt="" />
								      </button>
								      <input type="number" name="qty" class="inputQty" value="1" stockQty="{{ $stock->stock_quantity }}" mode="1">
								      <button class="plus-btn" name="button">
								        <img src="frontEnd\assets\dest\images\plus.svg" alt="" />
								      </button>
								      <p><span>{{ $stock->stock_quantity }}</span> sản phẩm có sẵn</p>
								    </div>

								    <div class="btn-add-cart"> 
								    	<button type="submit" style="border:none" name="modeAddCart" value="1"><a><i class="fa fa-shopping-cart"></i><span>Thêm Vào Giỏ Hàng</span></a></button>

								    	<button  class="addCartNow" type="submit" style="border:none" name="modeAddCart" value="2"><a><span>Mua Ngay</span></a></button>
								    </div>
									
									<div class="clearfix"></div>
								</div>
							{!! Form::close() !!}

						</div>
					</div>

					<div class="space40">&nbsp;</div>

					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Mô tả chi tiết</a></li>
							<li><a href="#tab-reviews">Comments (<span id="countCmt">{{ count($product->comment) }}</span>)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							{!! $product->detail_description !!}
						</div>
						<div class="panel" id="tab-reviews">
								@if(count($errors)>0)
                            		<div class="alert alert-danger"> 
                                	@foreach($errors->all() as $err)
                                    	{{ $err }}<br>
                               		@endforeach
                            		</div>    
                        		@endif
							    <div id="noticeComment"></div>								
				                <!-- Comments Form -->
				                <div class="well">
				                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
				                    <form role="form">
				                    	<input type="hidden" value="{{$product->id}}" id="productId">
				                        <div class="form-group">
				                            <textarea id="contentComment" class="form-control" rows="2" name="txtContent"></textarea>
				                        </div>
				                        <button type="submit" class="btn btn-primary" id="sendComment">Gửi</button>
				                    </form>
				                </div>

				                <hr>

				                <!-- Posted Comments -->

				                <!-- Comment -->
				                <div id="bodyComment">
					                <!-- Comment -->
					                @if( count($product->comment)==0 )
                        			<div class="textNullCmt"><p>Không có bình luận cho sản phẩm này</p></div>
                    				@else
										@foreach($product->comment as $item)
										<div class="media">
											<a class="pull-left" href="#">
												@if($item->user->gender == 1)
												<img class="media-object imgUserCmt" src="frontEnd\assets\dest\images\comments\icon_men.png" alt="">
												@else
												<img class="media-object imgUserCmt" src="frontEnd\assets\dest\images\comments\icon_woman.png" alt="">
												@endif
											</a>
											<div class="media-body">
												<h4 class="media-heading">{{ $item->user->name }}
													<small>{{ $item->created_at }}</small>
												</h4>
												{{ $item->content }}
											</div>
										</div>
										@endforeach
									@endif
								</div>

						</div>
					</div>
					<div class="space30">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm tương tự</h4>
						<div class="space30">&nbsp;</div>
						<div class="row">
							@foreach($productType as $key=>$item)
							<div class="col-sm-4">
								<div class="single-item">
									@if($item->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="{{ route('home.productDetail',$item->id)}}"><img src="upload/products/{{ $item->image }}" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{ $item->name }}</p>
										<p class="single-item-price">
											@if($item->promotion_price == 0)
											<span class="flash-sale">{{ number_format($item->unit_price,'0','','.') }}₫</span>
											@else
											<span class="flash-del">{{ number_format($item->promotion_price,'0','','.')}}₫</span>
											<span class="flash-sale">{{ number_format($item->unit_price,'0','','.') }}₫</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">

										{!! Form::open(['url'=>'home/shoppingCart','method'=>'POST']) !!}
										<input type="hidden" name="productId" value="{{ $item->id }}">
										<input type="hidden" name="qty" value="1">
										<button type="submit" style="border:none" class="add-to-cart pull-left" name="modeAddCart" value="1"><a class="add-to-cart pull-left"><i class="fa fa-shopping-cart"></i></a></button>
										{!! Form::close() !!}

										<a class="beta-btn primary" href="{{ route('home.productDetail',$item->id) }}">Chi tiết<i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="row">{{ $productType->links() }}</div>
					</div> <!-- .beta-products-list -->
				</div>

				<div class="col-sm-3 aside">

					<div class="widget">
						<h3 class="widget-title">Sản phẩm bán chạy</h3>
						<div class="widget-body">
							@foreach($productBestSale as $item)
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="{{ route('home.productDetail',$item->id)}}"><img src="upload/products/{{ $item->image }}" alt=""></a>
									<div class="media-body">
										{{ $item->name }}
										<span class="beta-sales-price">{{ number_format($item->unit_price,'0','','.') }}₫</span>
									</div>
								</div>
							</div>
							@endforeach

						</div>
					</div> <!-- best sellers widget -->

					<div class="widget">
						<h3 class="widget-title">Sản phẩm mới</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($productNews as $item)
								<div class="media beta-sales-item">
									<a class="pull-left" href="{{ route('home.productDetail',$item->id)}}"><img src="upload/products/{{ $item->image }}" alt=""></a>
									<div class="media-body">
										{{ $item->name }}
										<span class="beta-sales-price">{{ number_format($item->unit_price,'0','','.') }}₫</span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
	@endsection
	@section('script')
		<script src="{{ asset('frontEnd/assets/dest/js/quantity.js') }}"></script>	
		<!-- JS Cho Chức Năng Comment -->
		<script>
		$(document).ready(function(){
				$('#sendComment').on( 'click', function(e) {
        		e.preventDefault();
			  	var productId = $('.well #productId').val();
			  	var txtContent = $('.well #contentComment').val();
			
			  	$.ajax({
				    type:"POST",
				    url: "home/store/" + productId,
				    data: { 
				    	"_token": "{{ csrf_token() }}",
				    	"productId": productId , 
				    	"txtContent": txtContent , 
				    },
				    success: function(data){
				    	var tempt = data.success;
				    	if( tempt == 1){
				    		$('.well #contentComment').val('');
				    		$('#countCmt').text(data.countCmt);
				    		$('#bodyComment').html(data.html);
				    	}else{
				    		$('#noticeComment').html(data.html);
				    	}
				    	 	
				    },
				    error: function(data){
					 	console.log('Error:', data);
					}
			  	});
			});
		});	
	</script>
	<!-- JS Cho Chức Năng Image Products Child -->
	<script>
		$(document).ready(function(){
			$('.img-parent').zoom();

			$('img.child').click(function(){
				$('img.child').removeClass('boder-child');
				let img = $(this).attr('src');
				$('img#imgParent').attr('src',img);
				$(this).addClass('boder-child');
				$('.zoomImg').remove();
				$('.img-parent').zoom();
			})
		});
	</script>

@endsection
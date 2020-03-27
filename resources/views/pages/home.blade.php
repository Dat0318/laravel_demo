@extends('master')

@section('content')
<!--slider-->
<div class="rev-slider">
	<div class="fullwidthbanner-container">
		<div class="fullwidthbanner">
			<div class="bannercontainer" >
				<div class="banner" >
					<ul>
						
						@foreach( $slides as $item )
						<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
							<div class="slotholder" style="width:100%;height:100%;">
								<div class="tp-bgimg defaultimg" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" src="upload/slides/{{ $item->image }}" data-src="upload/slides/{{ $item->image }}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('upload/slides/{{ $item->image }}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
								</div>
							</div>
						</li>
						@endforeach
						
					</ul>
				</div>
			</div>

			<div class="tp-bannertimer"></div>
		</div>
	</div>
</div>

<!-- .container -->
<div class="container">

	<div id="content" class="space-top-none">
		<div class="main-content ">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-12 col-centered">

					<div class="beta-products-list">
						<h4><b>Sản Phẩm Mới</b></h4>
						<div class="beta-products-details">
							<?php $count = count($products); ?>
							<p class="pull-left">Tìm thấy {{ $count }} sản phẩm</p>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							<div id="carousel" class=" col-sm-12 carousel slide" data-ride="carousel" data-type="multi" data-interval="2500">
								<div class="carousel-inner">
									@foreach($products as $key=>$product )
									<div class="single-item item {{ $key==0 ? 'active':''}}">
										<div class="carousel-col">
											<div class="block img-responsive">
												@if($product->promotion_price != 0)
												<div class="ribbon-wrapper" id="carousel"><div class="ribbon sale">Sale</div></div>
												@endif

												<div class="single-item-header">
													<a href="{{ route('home.productDetail',$product->id)}}"><img src="upload/products/{{ $product->image }}" alt=""></a>
												</div>

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

												<div class="single-item-caption">

													{!! Form::open(['url'=>'home/shoppingCart','method'=>'POST']) !!}
													<input type="hidden" name="productId" value="{{$product->id}}">
													<input type="hidden" name="qty" value="1">
													<button type="submit" style="border:none" class="add-to-cart pull-left" name="modeAddCart" value="1"><a class="add-to-cart pull-left"><i class="fa fa-shopping-cart"></i></a></button>
													{!! Form::close() !!}

													<a class="beta-btn primary" href="{{ route('home.productDetail',$product->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>

								<!-- Controls -->
								<div class="left carousel-control">
									<a href="#carousel" role="button" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
								</div>
								<div class="right carousel-control">
									<a href="#carousel" role="button" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>
							</div>
						</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>

					<div class="beta-products-list">
						<h4><b>Tất Cả Sản Phẩm</b></h4>
						<div class="beta-products-details">
							<p class="pull-left">Tìm thấy {{ count($productsPaginate) }} sản phẩm</p>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach($productsPaginate as $key=>$item)
							<div class="col-sm-3">
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
							@if( ($key+1)%4==0 )
							<div class="space40">&nbsp;</div>
							@endif
							@endforeach
						</div>
						<div class="row">{{ $productsPaginate->links() }}</div>
					</div> <!-- .beta-products-list -->

				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->

</div>

@endsection
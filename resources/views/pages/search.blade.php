@extends('master')

@section('content')
<!-- .container -->
<div class="container">

	<div id="content" class="space-top-none">
		<div class="main-content ">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-12 col-centered">
					@if(count($products)==0)
					<div class="products-search">
						<div class="imageNotFound">
							<img src="frontEnd/assets/dest/images/search_not_found.png" alt="">
						</div>
						<div class="not-found-text"> Không tìm thấy sản phẩm phù hợp với từ khóa:<strong>{{ $keySearch }}</strong></div>
						<div class="tips-search">
						<span class="spacing">Mẹo tìm kiếm: </span>
						<div  class="spacing">
							<p>- Kiểm tra chính tả</p>
							<p>- Thử tìm kiếm với từ khóa khác</p>
							<p>- Tìm kiếm với các từ khóa thông dụng: <span>Samsung, iPhone, Kính cường lực, Oppo....<span>
						</div>
						</div>
					</div>
					@else
					<div class="beta-products-list">
						<h4><b>Tìm kiếm sản phẩm</b></h4>
						<div class="beta-products-details">
							<p class="pull-left">Tìm thấy {{ count($products) }} sản phẩm</p>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach($products as $key=>$item)
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
						<div class="row">{{ $products->links() }}</div>
					</div> <!-- .beta-products-list -->
				    @endif

				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
	
</div>

@endsection
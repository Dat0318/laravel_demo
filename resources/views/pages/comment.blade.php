@if( $status==1 )
	<!-- Comment -->
	@foreach($comments as $item)
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

@elseif( $status==2 )
	<div id="alert-notice">
		<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: center;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong><i class="fa fa-warning" style="font-size:20px;color:red"></i></strong> Bạn chưa nhập thông tin bình luận...
		</div>
	</div>
@else
	<div id="alert-notice">
		<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: center;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong><i class="fa fa-warning" style="font-size:20px;color:red"></i></strong> Vui lòng đăng nhập để viết bình luận...
		</div>
	</div>
@endif


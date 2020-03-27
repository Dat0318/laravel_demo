@extends('pages.account')

@section('title')
Đổi mật khẩu
@endsection

@section('contentAccount')
<div class="col-sm-9 contentAccount">
	@if(count($errors)>0)
        <div class="alert alert-danger"> 
            @foreach($errors->all() as $err)
                {{ $err }}<br>
            @endforeach
        </div>    
    @endif

    @if(session('notification'))
        <div class="alert alert-success"> 
            {{ session('notification') }}
        </div>
    @endif

    @if(session('warring'))
        <div class="alert alert-danger"> 
            {{ session('warring') }}
        </div>
    @endif
	<h4>Đổi mật khẩu</h4>
	<div class="space20">&nbsp;</div>
	<form action="{{ Route('home.changePassword',$user->id) }}" method="POST" >
		@csrf
		<div class="form-block">
			<label for="pass">Mật khẩu hiện tại <span style="color:red">(*)</span></label>
			<input type="password" name="oldPassword" class="inputPass" value="{{ old('oldPassword') }}">
		</div>
		<div class="form-block">
			<label for="pass">Mật khẩu mới <span style="color:red">(*)</span></label>
			<input type="password" name="newPassword" class="inputPass" >
		</div>
		<div class="form-block">
			<label for="pass">Nhập lại mật khẩu <span style="color:red">(*)</span></label>
			<input type="password" id="re_password" name="confirmPassword" class="inputPass">
		</div>
		<button type="submit" class="btn btn-success ml-24" >Cập nhật</button>
		<button type="reset" class="btn btn-primary" style="margin-left:0.5em">Nhập lại</button>
	</form>
</div>
@endsection
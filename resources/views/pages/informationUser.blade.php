@extends('pages.account')

@section('title')
Thông tin cá nhân
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
	<h4>Thông tin cá nhân</h4>
	<div class="space20">&nbsp;</div>
	<form action="{{ Route('home.updateAccount',$user->id) }}" method="POST" class="beta-form-checkout">
	@csrf
	<div class="form-block">
		<label for="email">Địa chỉ Email <span style="color:red">(*)</span></label>
		<input type="email" id="email" name="txtEmail" value="{{ $user->email }}" readonly>
	</div>
	<div class="form-block">
		<label for="your_last_name">Họ tên <span style="color:red">(*)</span></label>
		<input type="text" id="your_last_name" name="txtName" value="{{ $user->name }}">
	</div>
	<div class="form-block">
		<label for="adress">Địa chỉ <span style="color:red">(*)</span></label>
		<input type="text" id="adress" name="txtAddress" placeholder="Street Address"  value="{{ $user->address }}">
	</div>
	<div class="form-block">
		<label for="phone">Điện thoại <span style="color:red">(*)</span></label>
		<input type="text" id="phone" name="txtPhone"  value="{{ $user->phone }}">
	</div>
	<div class="form-block">
		    <label>Giới tính</label>
            <label>
                <input name="rdoGender" value="1" {{ ($user->gender == 1)?'checked':'' }} type="radio">Nam
            </label>
            <label>
                <input name="rdoGender" value="0" {{ ($user->gender == 0)?'checked':'' }} type="radio">Nữ
            </label>
	</div>
	<button type="submit" class="btn btn-success ml-24" id="btnUpdateAccount" disabled >Cập nhật</button>
</form>
</div>
@endsection
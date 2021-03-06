@extends('admin.layouts.index')
@section('content')

   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thông tin cá nhân
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    	@if(count($errors)>0)
                            <div class="alert alert-danger alert-dismissible">
                              <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                @foreach( $errors->all() as $key => $err )
                                      <strong>{{ ($key+1) }}.</strong>{{ $err }}<br>
                                @endforeach
                            </div>     
                        @endif

                        @if(session('notification'))
                            <div class="alert alert-success alert-dismissible">
                              <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>{{ session('notification') }}</strong>
                            </div>
                        @endif
                        
                        <form action="{{ Route('admin.account.update',$user->id) }}" method="POST">
                        	@csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="txtName" placeholder="Please Enter Username" value="{{ $user->name }}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="txtEmail" placeholder="Please Enter Email" value="{{ $user->email }}" readonly />
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="txtPhone" placeholder="Please Enter Phone" value="{{ $user->phone }}"/>
                            </div> 
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="txtAddress" placeholder="Please Enter Address" value="{{ $user->address }}"/>
                            </div>                           
							<div class="form-group">
                                <label>User Gender</label>
                                <div class="radioChecked" >
	                                <label class="radio-inline">
	                                    <input name="rdoGender" value="1" 
                                        {{ ($user->gender == 1)?'checked':'' }} type="radio">Nam
	                                </label>
	                                <label class="radio-inline">
	                                    <input name="rdoGender" value="0"
                                        {{ ($user->gender == 0)?'checked':'' }}  type="radio">Nữ
	                                </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection
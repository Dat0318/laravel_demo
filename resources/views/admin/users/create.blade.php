@extends('admin.layouts.index')
@section('content')

   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Add</small>
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
                        
                        <form action=" {{ Route('admin.user.store') }}" method="POST">
                        	@csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="txtName" value="{{old('txtName')}}" placeholder="Please Enter Username" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="txtEmail" value="{{old('txtEmail')}}" placeholder="Please Enter Email" />
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="txtPhone" value="{{old('txtPhone')}}" placeholder="Please Enter Phone" />
                            </div> 
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="txtAddress" value="{{old('txtAddress')}}" placeholder="Please Enter Address" />
                            </div>                           
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="txtPassword" placeholder="Please Enter Password" />
                            </div>
                            <div class="form-group">
                                <label>Re-Password</label>
                                <input type="password" class="form-control" name="txtRePassword" placeholder="Please Enter RePassword" />
                            </div>
							<div class="form-group">
                                <label>User Gender</label>
                                <div class="radioChecked" >
	                                <label class="radio-inline">
	                                    <input name="rdoGender" value="1" checked="" type="radio">Male
	                                </label>
	                                <label class="radio-inline">
	                                    <input name="rdoGender" value="0"  type="radio">Female
	                                </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>User Level</label>
                             	<div class="radioChecked">
	                                <label class="radio-inline">
	                                    <input name="rdoLevel" value="0" checked="" type="radio">Customer
	                                </label>
	                                <label class="radio-inline">
	                                    <input name="rdoLevel" value="1"  type="radio">Employee
	                                </label>
	                                <label class="radio-inline">
	                                    <input name="rdoLevel" value="2" type="radio">Admin
	                                </label>
                            	</div>
                            </div>
                            <button type="submit" class="btn btn-success">Add</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <a class="btn btn-danger" href="{{ Route('admin.dashboard.index') }}" role="button">Cancel </a>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection
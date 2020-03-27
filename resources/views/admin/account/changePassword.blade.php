@extends('admin.layouts.index')
@section('content')

   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thay đổi mật khẩu
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

                        @if(session('warring'))
                        <div class="alert alert-danger alert-dismissible">
                            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{ session('warring') }}</strong>
                        </div>
                        @endif
                        
                        <form action="{{ Route('admin.account.changePassword',$user->id) }}" method="POST">
                        	@csrf
                            <div class="form-group">
                                <label>Mật khẩu hiện tại <span style="color:red">(*)</span></label>
                                <input type="password" class="form-control"  name="oldPassword" placeholder="Nhập mật khẩu" value="{{ old('oldPassword') }}" />
                            </div>
                            <div class="form-group">
                                <label>Nhập mật khẩu mới</label>
                                <input type="password" class="form-control"  name="newPassword" placeholder="Nhập mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="confirmPassword" placeholder="Nhập lại mật khẩu"/>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <a href="{{ Route('admin.product.index') }}" class="btn btn-warning"> Back </a>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection
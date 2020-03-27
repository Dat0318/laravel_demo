@section('link')
<link href="{{ asset('backEnd/dist/css/fileinput.css') }}" rel="stylesheet" type="text/css">    
@endsection
@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <!-- Hiển thị thông báo lỗi và thông báo thành công thi thêm sản phẩm -->
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
                <!-- Hiển thị form thêm sản phẩm-->
                <form action="{{ Route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="txtName" placeholder="Please Enter Product Name" />
                    </div>                            
                    <div class="form-group">
                        <label>Product Type</label>
                        <select class="form-control" name="optCategory">
                            @foreach($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" min="0" max="100000000"   class="form-control" name="noPrice" placeholder="Please Enter Price" />
                    </div>
                    <div class="form-group">
                        <label>Promotion Price</label>
                        <input type="number" min="0" max="100000000"   class="form-control" name="noPromotionPrice" placeholder="Please Enter Promotion Price" value="0" />
                    </div>
                    <div class="form-group">
                        <label>Main Product Image</label>
                        <div class="alert-notice">
                            <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p> Bạn chỉ được thêm
                                <strong style="color: red"> 1 </strong> ảnh chính mới.</p>
                            </div>
                        </div>
                        <div class="file-loading">
                            <input id="file-2" type="file" name="inputMainImage" class="file" data-overwrite-initial="false" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Child Images</label>
                        <div class="alert-notice">
                            <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p> Bạn có thể thêm tối đa 
                                <strong style="color: red"> 2 </strong> ảnh con mới. Không trùng ảnh chính</p>
                            </div>
                        </div>
                        <div class="file-loading">
                            <input id="file-1" type="file" name="inputImage[]" multiple class="file" data-overwrite-initial="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Product Unit</label>
                        <select class="form-control" name="txtUnit">
                            <option value="Chiếc">Chiếc</option>
                            <option value="Đôi">Đôi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea class="form-control" name="txtDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Product Detail Description</label>
                        <textarea id="demo" name="txtDetailDescription" class="ckeditor form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Product Status</label>
                        <label class="radio-inline">
                            <input name="rdoStatus" value="1" checked="" type="radio">New
                        </label>
                        <label class="radio-inline">
                            <input name="rdoStatus" value="0" type="radio">Old
                        </label>
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
<!-- /#page-wrapper -->
@endsection

@section('script')
 <script src="{{ asset('backEnd/dist/js/fileinput.js') }}" type="text/javascript"></script>
 <script src="{{ asset('backEnd/dist/js/theme.js') }}" type="text/javascript"></script>
 <script src="{{ asset('backEnd/dist/js/popper.min.js') }}" type="text/javascript"></script>
 <script type="text/javascript">
    $("#file-1").fileinput({
        theme: 'fa',
        allowedFileExtensions: ['jpg', 'png', 'gif','.jpeg'],
        overwriteInitial: false,
        maxFileSize:2000,
        maxFileCount:2,    
    });
    $("#file-2").fileinput({
        theme: 'fa',
        allowedFileExtensions: ['jpg', 'png', 'gif','.jpeg'],
        overwriteInitial: false,
        maxFileSize:2000,
        maxFileCount:1,    
    });
</script>

@endsection
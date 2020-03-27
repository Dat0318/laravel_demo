
@extends('admin.layouts.index')
@section('link')
<link href="{{ asset('backEnd/dist/css/fileinput.css') }}" rel="stylesheet" type="text/css">    
@endsection
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
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
                <form action="{{ Route('admin.slide.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" name="txtTitle" placeholder="Please Enter Title"/>
                    </div>                        

                    <div class="form-group">
                        <label>Images</label>
                        <div class="file-loading">
                            <input id="file-2" type="file" name="inputImage" class="file" data-overwrite-initial="false" >
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
<!-- /#page-wrapper -->
@endsection

@section('script')
 <script src="{{ asset('backEnd/dist/js/fileinput.js') }}" type="text/javascript"></script>
 <script src="{{ asset('backEnd/dist/js/theme.js') }}" type="text/javascript"></script>
 <script src="{{ asset('backEnd/dist/js/popper.min.js') }}" type="text/javascript"></script>
 <script type="text/javascript">
    $("#file-2").fileinput({
        theme: 'fa',
        allowedFileExtensions: ['jpg', 'png', 'gif','.jpeg'],
        overwriteInitial: false,
        maxFileSize:2048,
        maxFileCount:1,    
    });
</script>

@endsection
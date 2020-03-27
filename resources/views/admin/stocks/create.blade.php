
@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Stock
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
                <form action="{{ Route('admin.stock.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="hidden" name="stockId" value="{{ $stock->id }}">
                        <input type="text" class="form-control" name="txtNameProduct"  value="{{ $products->name }}" readonly="" />
                    </div>                      

                    <div class="form-group">
                        <label>Product Quantity</label>
                        <input type="number" min="1"  class="form-control" name="productQuantity" placeholder="Please Enter Product Quantity" value="1" />
                    </div>

                    <div class="form-group">
                        <label>Original Price</label>
                        <input type="number" min="1000"  class="form-control" name="originalPrice" placeholder="Please Enter Original Price" value="1000" />
                    </div>

                    <div class="form-group">
                        <label>Note</label>
                        <textarea id="demo" name="txtNote" class="ckeditor form-control" rows="3"> </textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a class="btn btn-danger" href="{{ Route('admin.stock.index') }}" role="button">Cancel </a>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
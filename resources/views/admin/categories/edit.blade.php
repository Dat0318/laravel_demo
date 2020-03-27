@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Edit</small>
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
                
                <form action="admin/category/update/{{ $category->id }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control" name="txtCateName" placeholder="Please Enter Category Name" value="{{ $category->name }}" />
                    </div>
                    <div class="form-group">
                        <label>Category Description</label>
                        <textarea class="form-control" rows="3" name="txtDescription">{{ $category->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a class="btn btn-danger" href="{{ Route('admin.category.index') }}" role="button">Cancel </a>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
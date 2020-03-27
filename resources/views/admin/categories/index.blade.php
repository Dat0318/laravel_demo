@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Category
                <small>List</small>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="alert alert-info alert-dismissible" style="position: relative; clear: both; width: 40%;">
                <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Các thể loại đã có sản phẩm sẽ không được xóa...</strong>
        </div>
        @if(session('notification'))
            <div class="alert alert-success alert-dismissible" style="position: relative; clear: both; width: 40%;">
                <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{ session('notification') }}</strong>
            </div>
        @endif
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>STT</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category as $key => $item)
                <tr class="odd gradeX" align="center">
                    <td>{{ ++$key }}</td>
                    <td class="text-left">{{ $item->name }}</td>
                    <td class="text-left">{{ $item->description }} </td>
                    <td class="center {{(($item->countID) > 0) ? 'cursor-not-allowed':''}}">
                    <a href="{{ Route('admin.category.destroy', $item->id) }}" style="display: none"></a>
                    <a class="{{(($item->countID)> 0) ? 'disabled':'enable'}} btn btn-danger remove"><i class="fa fa-trash-o  fa-fw"></i>
                    Delete</a>
                    </td>
                    <td class="center">
                        <a href="{{ Route('admin.category.edit', $item->id) }}" class="btn btn-warning"><i class="fa fa-pencil fa-fw"></i> Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('modal')
<div class="modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Xóa Thể Loại</h5>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc chắn muốn xóa thể loại không?</p>

      </div>
      <div class="modal-footer">
        <a href="" style="display: none"></a>
        <button type="button" class="btn btn-primary" id="btnAgree">
        Đồng Ý</button>
        <button type="button" class="btn btn-danger" id="closeConfirm">Thoát</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('backEnd/dist/js/confirmDelete.js') }}"></script>
@endsection
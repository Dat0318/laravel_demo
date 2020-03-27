@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
                <div class="row" style="padding-bottom:20px">
            <div class="col-lg-12">
                <h1 class="page-header">Comment
                    <small>List</small>
                </h1>
            </div>

            @if(session('notification'))
                <div class="alert alert-success alert-dismissible" style="position:relative; clear:both; width:50%; ">
                  <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong> {{ session('notification') }} </strong>
                </div>
            @endif

            @if( count($products->comment)==0 )
                <div class="col-lg-12"><h4>Không có bình luận nào cho sản phẩm này</h4></div>
            @else
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>User Name</th>
                        <th>Content</th>
                        <th>Created_at</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products->comment as $key=>$item)
                        <tr class="odd gradeX" align="center">
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td class="text-left">{{ $item->content }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td class="center">
                                <a href="{{ Route('admin.comment.destroy',[$item->id,$products->id]) }}"
                                style="display: none"></a>
                                <a class="btn btn-danger remove"> <i class="fa fa-trash-o  fa-fw"></i>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <!-- /.End-row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@section('modal')
<div class="modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Xóa Bình Luận</h5>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc chắn muốn xóa bình luận không?</p>

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


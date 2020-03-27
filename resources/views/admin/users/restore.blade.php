@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
             @if(session('notification'))
                <div class="alert alert-success alert-dismissible" style="position: relative;clear: both;width:40%;">
                  <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>{{ session('notification') }}</strong>
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Delete</th>
                        <th>Restore</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ ($item->gender==1) ? 'Nam':'Nữ'}}</td>
                            <td>{{ ($item->role==0) ? 'Khách hàng':(($item->role==1) ? 'Employee':'Admin') }}</td>
                            <td class="center {{ ($item->countID > 0)?'cursor-not-allowed':'' }}" >
                                <a href="{{ Route('admin.user.destroyAll', $item->id) }}"
                                style="display: none"></a>
                                <a class="btn btn-danger remove" {{ ($item->countID > 0)?'disabled':'' }}><i class="fa fa-trash-o  fa-fw"></i> Delete</a>
                            </td>
                            <td class="center" ><a href="{{ Route('admin.user.restore', $item->id) }}" class="btn btn-success"><i class="fa fa-refresh"></i> Restore </a></td>   
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@section('modal')
<div class="modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Xóa Thông Tin Người Dùng</h5>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc chắn muốn xóa hết thông tin <br>
        liên quan về người dùng này không ?</p>

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
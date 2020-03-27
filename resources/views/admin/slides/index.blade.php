@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
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
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slides as $key => $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{ ++$key }}</td>
                            <td class="text-left">{{ $item->title }}</td>
                            <td class="text-left">{{ $item->slug }}</td>
                            <td style="width: 20%"><img src="upload/slides/{{ $item->image }}" class="imgSlide"></td>
                            <td class="center">
                                <a href="{{ Route('admin.slide.destroy', $item->id) }}"
                                style="display: none"></a>
                                <a class="btn btn-danger remove"><i class="fa fa-trash-o  fa-fw"></i>Delete</a>
                            </td>
                            <td class="center">
                                <a href="{{ Route('admin.slide.edit', $item->id) }}" class="btn btn-warning"><i class="fa fa-pencil fa-fw"> </i>Edit</a></td>
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
        <h5 class="modal-title">Xóa Ảnh Slide Trang Chủ</h5>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc chắn muốn xóa ảnh của slide không?</p>

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


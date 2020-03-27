@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-10">
                <h1 class="page-header-account">Product
                    <small>List </small>
                </h1>
                </div>
                <div class="col-md-2 selectTop-product" style="margin-top:20px; display: flex;">
                    <a href="{{ Route('admin.product.create') }}" class="btn btn-success" style="margin-right:8px"><i class="fa fa-plus fa-fw"></i>Add</a>
                    <a href="{{ Route('admin.product.showRestore') }}" class="btn btn-primary"><i class="fa fa-refresh"></i> Restore </a>
                </div>
            </div>
            <!-- /.col-lg-12 -->
             @if(session('notification'))
                <div class="alert alert-success alert-dismissible" style="position:relative; clear:both; width:50%; ">
                  <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong> {{ session('notification') }} </strong>
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Detail Description</th>
                        <th>Price</th>
                        <th>Promotion Price</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listProduct as $key => $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{ ++$key }}</td>
                            <td class="text-left">{{ $item->name }}</td>
                            <td class="text-left">{{ $item->description }}</td>
                            <td class="text-left">{!! $item->detail_description !!}</td>
                            <td>{{ number_format($item->unit_price,'0','','.') }}</td>
                            <td>{{ number_format($item->promotion_price,'0','','.') }}</td>
                            <td class="center" >
                                <a href="{{ Route('admin.product.destroy', $item->id) }}"
                                style="display: none"></a>
                                <a class="btn btn-danger remove"><i class="fa fa-trash-o  fa-fw"></i> Delete</a>
                            </td>
                            <td class="center"><a href="{{ Route('admin.product.edit', $item->id) }}" class="btn btn-warning"><i class="fa fa-pencil fa-fw"></i> Edit</a></td>
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
        <h5 class="modal-title">Xóa Sản Phẩm</h5>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc chắn muốn xóa sản phẩm không?</p>

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

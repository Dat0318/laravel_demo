@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Orders
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
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Note</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key=>$item)
                        <tr class="odd gradeX" align="center">
                            <td>{{ ++$key }}</td>
                            <td class="text-left">{{ $item->customers_name }}</td>
                            <td class="text-left">{{ $item->customers_address }}</td>
                            <td class="text-left">{{ $item->customers_email }}</td>
                            <td class="text-left">{{ $item->customers_phone }}</td>
                            <td>{{ number_format($item->amount,'0','','.') }}</td>
                            <td>{{ $item->payment }}</td>
                            <td class="text-left">{!! $item->note !!}</td>
                            <td>{{ $item->date_order }}</td>
                            
                            @if($item->status == 4)
                            <td class="text-left">
                            <span class="btn btn-primary">Đang mua hàng</span>
                            </td>
                            @else
                            <td class="text-left">
                            <span class="btn {{ ($item['status']==0)?'btn-warning':( ($item['status']==1 )? 'btn-info':( ($item['status']==2 )? 'btn-success':'btn-danger' )) }} ">
                            {{ ($item['status']==0)? 'Chưa xử lý':( ($item['status']==1 )? 'Đang vận chuyển':( ($item['status']==2 )? 'Giao thành công':'Đã hoàn lại' )) }}</span>
                            </td>
                            @endif                          
                            <!-- <td class="center">
                                <a href="{{ Route('admin.order.destroy',$item->id) }}"
                                style="display: none"></a>
                                <a class="btn btn-danger remove"><i class="fa fa-trash-o  fa-fw"></i></a>
                            </td> -->
                            <td class="center"><a href="{{ Route('admin.order.edit',$item->id) }}" class="btn btn-warning"><i class="fa fa-eye fa-fw"></i></a></td>
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
        <h5 class="modal-title">Xóa Đơn Hàng</h5>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc chắn muốn xóa đơn hàng không?</p>

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
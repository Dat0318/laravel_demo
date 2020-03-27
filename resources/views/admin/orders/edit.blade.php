@extends('admin.layouts.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chi tiết
                    <small>Đơn hàng</small>
                </h1>
            </div>

            @if( $order->status==3 )
                <div class="alert alert-info alert-dismissible" style="position:relative;clear:both;width:50%;">
                  <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Sản phẩm đã hoàn lại sẽ không thể xử lý trạng thái giao hàng</strong>
                </div>
            @endif
            @if(session('notification'))
                <div class="alert alert-success alert-dismissible" style="position: relative; clear: both; width: 40%;">
                    <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ session('notification') }}</strong>
                </div>
            @endif                    
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <div class="container123  col-lg-6">
                    <table class="table table-bordered" id="inforCustomer">

                        <h4><b>Thông tin khách hàng</b></h4>
                        <tbody>
                            <tr>
                                <td>Tên người đặt hàng</td>
                                <td>{{ $order->customers_name }}</td>
                            </tr>
                            <tr>
                                <td>Ngày đặt hàng</td>
                                <td>{{ $order->date_order }}</td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td>{{ $order->customers_phone }}</td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>{{ $order->customers_address }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $order->customers_email }}</td>
                            </tr>
                            <tr>
                                <td>Thanh toán</td>
                                <td>{{ $order->payment }}</td>
                            </tr>
                            <tr>
                                <td>Ghi chú</td>
                                <td>{{ $order->note }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderDetailInfo as $key => $orderDetail)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $orderDetail->products_name }}</td>
                            <td>{{ number_format($orderDetail->products_unit_price,'0','','.') }}</td>
                            <td>{{ $orderDetail->products_quantity }}</td>
                            <td>
                            {{ number_format($orderDetail->products_unit_price*$orderDetail->products_quantity,'0','','.') }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>            
            </div>
            <!-- End Chi Tiết Giỏ Hàng -->
            <div class="col-lg-12" id="txtTotalCart">
                <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <label> Tổng Tiền: <span class="text-red">{{ number_format($order->amount,'0','','.') }} VNĐ</span></label>
                    </div>
            </div>
            <!-- End Tổng tiền -->
            <div class="col-lg-12" id="ctrPayment">
                <form action="{{ Route('admin.order.update', $orders_id ) }}" method="POST">
                    @csrf
                    <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <div class="form-inline">
                            <label>Trạng thái giao hàng: </label>
                            <select name="status" class="form-control input-inline" style="width: 200px">
                                <option value="0" {{ ( $order->status==0)?'selected':'' }}>Chưa xử lý</option>
                                <option value="1" {{ ( $order->status==1)?'selected':'' }}>Đang vận chuyển</option>
                                <option value="2" {{ ( $order->status==2)?'selected':'' }}>Giao thành công</option>
                                <option value="3" {{ ( $order->status==3)?'selected':'' }}>Đã hoàn lại</option>
                            </select>
                            <span class="{{ ($order->status==3)?'cursor-not-allowed':'' }}">
                                <input type="submit" value="Xử lý" class="btn btn-primary" {{ ( $order->status==3)?'disabled':'' }}>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End Xử Lý Đơn Hàng -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
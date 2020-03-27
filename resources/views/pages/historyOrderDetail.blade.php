@extends('pages.account')

@section('title')
Đơn hàng chi tiết
@endsection 

@section('contentAccount')
<div class="col-sm-9 contentAccount">
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                    <h4 class="page-header-account"> Đơn hàng chi tiết </h4>
                    <table class="table table-striped table-bordered table-hover table-historyOrderDetail">
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
                            @foreach($orderDetail as $key => $item)
                                <tr class="odd gradeX" align="center">
                                    <td class="center">{{ ++$key }}</td>
                                    <td>{{ $item->products_name }}</td>
                                    <td>{{ number_format($item->products_unit_price,'0','','.') }}</td>
                                    <td class="center">{{ $item->products_quantity }}</td>
                                    <td>{{ number_format(($item->products_unit_price*$item->products_quantity),'0','','.')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
</div>
@endsection
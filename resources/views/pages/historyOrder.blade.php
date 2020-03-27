@extends('pages.account')

@section('title')
Lịch sử đơn hàng
@endsection

@section('contentAccount')
<div class="col-sm-9 contentAccount">
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                    <h4 class="page-header-account"> Lịch sử đơn hàng </h4>
                    @if(count($order)==0)
                    <div class="notice-cart-null">
                        <div class="img-null">
                            <img src="frontEnd\assets\dest\images\null.png">
                        </div>
                        <h5>Bạn không có đơn hàng nào trong shop</h5>
                        <div class="connect-home"> <a href="{{ Route('home.index') }}"> ĐẾN TRANG CHỦ PHỤ KIỆN PHONG PHÚ </a></div>
                    </div>
                    @else
                    <table class="table table-striped table-bordered table-hover table-historyOrder">
                        <thead>
                            <tr align="center">
                                <th>Đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th>Chú thích</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $key => $item)
                                <tr class="odd gradeX" align="center">
                                    <td class="center">{{ ++$key }}</td>
                                    <td>{{ number_format($item->amount,'0','','.') }}</td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{!! $item->note !!}</td>
                                    <td>{{ $item->date_order }}</td>
                                    <td class="text-left">
                                    <span class="btn {{ ($item['status']==0)?'btn-warning':( ($item['status']==1 )? 'btn-info':( ($item['status']==2 )? 'btn-success':'btn-danger' )) }} ">
                                    {{ ($item['status']==0)? 'Chưa xử lý':( ($item['status']==1 )? 'Đang vận chuyển':( ($item['status']==2 )? 'Giao thành công':'Đã hoàn lại' )) }}
                                    </span>
                                    </td>
                                     <td class="center"><a href="{{ Route('home.historyOrderDetail',[ $item->id, $user->id]) }}"><i class="fa fa-eye" style="font-size:20px;color: #FFD200"></i> </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
</div>
@endsection
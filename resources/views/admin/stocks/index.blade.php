@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-5">
                <h1 class="page-header-account">Stock
                    <small>List </small>
                </h1>
                </div>
                <div class="col-md-7" style="margin-top:20px; display: flex;">
                    <p style="margin-right: 15px"><i class="fa fa-circle" style="color:#0873b9"></i>&nbsp Tổng doanh thu: <strong>{{ number_format($sumAmount,'0','','.') }}</strong></p>
                    <p style="margin-right: 15px"><i class="fa fa-circle" style="color:#FAE70F"></i>&nbsp Chi phí: <strong>{{ number_format($sumFee,'0','','.') }}</strong></p>
                    <p><i class="fa fa-circle" style="color:#06FB0C"></i>&nbsp Tổng lợi nhuận: <strong>{{ number_format($sumAmount - $sumFee,'0','','.') }}</strong></p>
                </div>
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
                        <th>Product Name</th>
                        <th>Total Import Quantity</th>
                        <th>Stock Quantity</th>
                        <th>View Detail</th>
                        <th>Add Import Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $key => $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{ ++$key }}</td>
                            <td class="text-left">{{ $item->product->name }}</td>
                            <td>{{ $item->total_quantity }}</td>
                            <td>{{ $item->stock_quantity }}</td>
                            <td class="center"> 
                                <a href="{{ Route('admin.stock.show',$item->id) }}" class="btn btn-info"><i class="fa fa-eye fa-fw"></i>Watch</a>
                            </td>
                            <td class="center"><a href="{{ Route('admin.stock.create', $item->id) }}" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Add</a></td>
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


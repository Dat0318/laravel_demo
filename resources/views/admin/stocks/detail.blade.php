@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Stock
                    <small>List Detail</small>
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
                        <th>Stock Id</th>
                        <th>Import Quantity</th>
                        <th>Original Price</th>
                        <th>Note</th>
                        <th>Import Date</th>
                        <th>Update Date</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stockDetail as $key=>$item)
                        <tr class="odd gradeX" align="center">
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->stocks_id }}</td>
                            <td>{{ $item->import_quantity }}</td>
                            <td>{{ number_format($item->original_price,'0','','.') }}</td>
                            <td  class="text-left">{!! $item->note !!}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td class="center"><a href="{{ Route('admin.stock.edit',$item->id)}}" class="btn btn-warning"><i class="fa fa-pencil fa-fw"></i> Edit</a></td>
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
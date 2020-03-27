@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header-account">Product
                    <small>List </small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Watch Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $key+1 }}</td>
                            <td class="text-left">{{ $item->name }}</td>
                            <td>{{ ($item->status ==1) ? 'Mới':'Cũ'}}</td>
                            <td class="center"> 
                                <a href="{{ Route('admin.comment.show',$item->id) }}" class="btn btn-info"><i class="fa fa-eye fa-fw"></i>Watch</a>
                            </td>
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


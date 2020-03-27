@extends('admin.layouts.index')
@section('link')
<link href="{{ asset('backEnd/dist/css/fileinput.css') }}" rel="stylesheet" type="text/css">    
@endsection
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:20px">
                <!-- Hiển thị thông báo lỗi và thông báo thành công thi thêm sản phẩm -->
                @if(count($errors)>0)
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>
                    @foreach( $errors->all() as $err )
                            {{ $err }}<br>
                    @endforeach</strong>
                    </div>      
                @endif

                @if(session('notification'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>{{ session('notification') }}</strong>
                    </div>
                @endif
                <!-- Hiển thị form thêm sản phẩm-->
                <form action="{{ Route('admin.product.update',$products->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="txtName" placeholder="Please Enter Product Name"value="{{ $products->name }}" />
                    </div> 

                    <div class="form-group">
                        <label>Product Type</label>
                        <select class="form-control" name="optCategory">
                            @foreach($categories as $item)
                                @if(  $products->categories_id == $item->id )
                                    <option value="{{ $item->id }}" selected='selected'> {{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" min="0" max="100000000"   class="form-control" name="noPrice" placeholder="Please Enter Price" value="{{ $products->unit_price }}"/>
                    </div>

                    <div class="form-group">
                        <label>Promotion Price</label>
                        <input type="number" min="0" max="100000000"   class="form-control" name="noPromotionPrice" placeholder="Please Enter Promotion Price" value="{{ $products->promotion_price }}"/>
                    </div>

                    <div class="form-group ">
                        <label>Images</label>
                        <!-- Hiển thị thông báo khi xóa ảnh -->
                        @if(session('noticeUpdateImage'))
                            <div id="alert-notice">
                                <div class="alert alert-success alert-dismissible" role="alert" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <p>{{ session('noticeUpdateImage') }}. Bạn có thể thêm tối đa 
                                    <strong style="color: red">{{ 2-count($imagesProduct) }}</strong> ảnh mới. Không trùng ảnh chính</p>
                                </div>
                            </div>
                        @else
                            @if( count($imagesProduct)>=0 && count($imagesProduct)<2 )
                            <div id="alert-notice">
                                <div class="alert alert-info alert-dismissible" role="alert" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <p>Bạn có thể thêm tối đa 
                                    <strong style="color: red">{{ 2-count($imagesProduct) }}</strong> ảnh con mới. Không trùng ảnh chính</p>
                                </div>
                            </div>
                            @endif
                        @endif

                        <!-- Hiển thị ảnh cũ -->
                        <!-- Nếu ảnh của sản phẩm không trống thì mới hiện -->
                        @if(!empty($products->image)) 
                        <div class="form-old-image">
                        <!-- Form Edit Main Image -->
                        <label style="margin-left: 15px;">Old Main Image</label>
                            <div class="img-edit" id="{{ $products->id }}">
                                <img src="upload/products/{{ $products->image }}" alt="">
                                <div class="pro-del"><a href="{{ Route('admin.product.destroyMainImage',$products->id )}}"><i class="fa fa-times-circle"></i></a>
                                </div>
                            </div>
                        </div>
                        @else 
                        <div class="form-group" id="formNewMainImage">
                            <label>New Main Images</label>
                            <div class="file-loading">
                                <input id="file-2" type="file" name="inputMainImage" class="file" data-overwrite-initial="false" required>
                            </div>
                        </div>
                        @endif

                        <!-- Form Edit Child Images -->
                        @if( count($imagesProduct)!=0 )
                        <div class="form-old-image">
                        <label style="margin-left: 15px;">Old Child Images</label>
                            @foreach($imagesProduct as $item)
                            <div class="img-edit img-child" id="{{ $item->id }}">
                                <img src="upload/products/{{ $item->image }}" alt="">
                                <div class="pro-del"><a href="{{ Route('admin.product.destroyImage',$item->id )}}"><i class="fa fa-times-circle"></i></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <input type="hidden" id="countOldImage" value="{{ count($imagesProduct) }}">
                        <div class="form-group" id="formNewChildImage"  hidden>
                            <label>New Child Images</label>
                            <div class="file-loading">
                                <input id="file-1" type="file" name="inputImage[]" multiple class="file" data-overwrite-initial="false">
                            </div>
                        </div>
                        <!-- End form -->
                    </div>
            

       
                    <div class="form-group">
                        <label>Product Unit</label>
                        <select class="form-control" name="txtUnit">
                            <option value="Chiếc" {{ ($products->unit=="Chiếc")?'selected':'' }}>Chiếc</option>
                            <option value="Đôi" {{ ($products->unit=="Đôi")?'selected':'' }}>Đôi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea class="form-control" name="txtDescription" rows="3">{{ $products->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Product Detail Description</label>
                        <textarea id="demo" name="txtDetailDescription" class="ckeditor form-control" rows="3">{{ $products->detail_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Product Status</label>
                        <label class="radio-inline">
                            <input name="rdoStatus" value="1"
                             @if( $products->status == 1 )
                                {{"checked"}}
                             @endif
                             type="radio">New
                        </label>
                        <label class="radio-inline">
                            <input name="rdoStatus" value="0" 
                            @if( $products->status == 0 )
                                {{"checked"}}
                             @endif  
                            type="radio">Old
                        </label>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a class="btn btn-danger" href="{{ Route('admin.product.index') }}" role="button">Cancel </a>
                <form>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('script')
 <script src="{{ asset('backEnd/dist/js/fileinput.js') }}" type="text/javascript"></script>
 <script src="{{ asset('backEnd/dist/js/theme.js') }}" type="text/javascript"></script>
 <script src="{{ asset('backEnd/dist/js/popper.min.js') }}" type="text/javascript"></script>
 <script>
    $(document).ready(function(){
        var countOldImg = parseInt($('#countOldImage').val());
        if(countOldImg < 2){
            $('#formNewChildImage').removeAttr('hidden');
        }else{
             $('#formNewChildImage').attr("hidden",true);
        }
    });
 </script>
 <script type="text/javascript">
    var count = $('div.img-child').length;
    var maxCount = 2-count;
    $("#file-1").fileinput({
        theme: 'fa',
        allowedFileExtensions: ['jpg', 'png', 'gif','.jpeg'],
        overwriteInitial: false,
        maxFileSize:2000,
        maxFileCount:maxCount,
    });
    $("#file-2").fileinput({
        theme: 'fa',
        allowedFileExtensions: ['jpg', 'png', 'gif','.jpeg'],
        overwriteInitial: false,
        maxFileSize:2000,
        maxFileCount:1,
    });
</script>
@endsection

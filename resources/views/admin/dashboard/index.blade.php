@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper" style="padding-top: 1em">
    <div class="container-fluid">
        <!-- Stock list -->
        <div id="chartContainer2" style="height: 300px; width: 100%;"></div>
        @foreach($stockList as $item)
            <input type="hidden" name="valY[]" nameProductStock="{{ $item->name }}" value="{{ $item->stockQty}}">
        @endforeach
        <!-- Total ProductSale List -->
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        @foreach($productSale as $item)
            <input type="hidden" name="valueY[]" nameProduct="{{ $item->name }}" value="{{ $item->total_sale_quantity}}">
        @endforeach
        

    </div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
@section('script')
<script src="{{ asset('backEnd/dist/js/canvasjs.min.js') }}"></script>
<script type="text/javascript">

window.onload = function () {
    var dps = [] ;
    var dps2 = [];
    
    $("input[name='valueY[]']").each(function() {
        dps.push({ y:Number($(this).val()) , label: $(this).attr('nameProduct')});
    });

    $("input[name='valY[]']").each(function() {
        dps2.push({ y:Number($(this).val()) , label: $(this).attr('nameProductStock')});
    });

    var chart = new CanvasJS.Chart("chartContainer", {
        title:{
            text: "Bieu Do Thong Ke San Pham Da Ban"              
        },
        data: [              
        {
            type: "column",
            dataPoints: dps
        }
        ]
    });
    var chart2 = new CanvasJS.Chart("chartContainer2", {
        title:{
            text: "Bieu Do Thong Ke So Luong Ton Kho"              
        },
        data: [              
        {
            type: "column",
            dataPoints: dps2
        }
        ]
    });
    chart.render();
    chart2.render();
    $('.canvasjs-chart-credit').text('');
}
</script>
@endsection
@extends('admin.layout.default')
@section('title')
Sale Panel
@stop
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
 
<!--end of page level css-->
@stop

@section('content')
<section class="content-header">
    <h1>Sale</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Sale</li>
        <li class="active">Sale</li>
    </ol>
</section>
<div class="container-fluid" >
     <div class="row" id="printableArea">
        <div class="col-xs-12">
          <h4 style="text-align:center;">My Own Shop</h4>
          <h4 style="text-align:center;">My Own Shop</h4>
          <h4 style="text-align:center;">My Own Shop</h4>
        </div>
       
        <div class="col-xs-12" style="border-bottom:1px solid #333;">
          <span style="width:49%;font-size:12px;">Sales Receipt</span>
          <span style="width:49%;font-size:12px;float:right;text-align:right;"><?php echo(date("d/m/Y")); ?></span>
           
        </div>
          <div class="col-xs-12" style="text-align:center;border-bottom:1px solid #333;">
            <span style="width:49%;font-size:12px;text-align:right;">Customer Name :</span>
            <span style="width:49%;font-size:12px;text-align:left;">{{ $customer }}</span>
          </div>
          
         <?php $qty = 0; ?>
        <div class="col-xs-12">
          <div style="float:left;width:40%;text-align:left;">
            <span style="font-size:12px;">Name</span>
          </div>
          <div style="float:left;width:20%;text-align:left;">
            <span style="font-size:12px;">Price</span>
          </div>
          <div style="float:left;width:10%;text-align:left;">
            <span style="font-size:12px;">Qty</span>
          </div>
          <div style="float:left;width:30%;text-align:right;">
            <span style="font-size:12px;">Total</span>
          </div>
        </div>
        <div class="col-xs-12" style="border-bottom:1px solid #333;">
        @foreach($shoppingcart as $value)
          <div style="float:left;width:40%;text-align:left;">
            <span style="font-size:12px;">{{$value->name}}</span>
          </div>
          <div style="float:left;width:20%;text-align:left;">
            <span style="font-size:12px;">{{$value->price}}</span>
          </div>
          <div style="float:left;width:10%;text-align:left;">
            <span style="font-size:12px;">{{$value->qty}}</span>
          </div>
          <div style="float:left;width:30%;text-align:right;">
            <span style="font-size:12px;">{{$value->subtotal}}</span>
          </div>
          <?php $qty += $value->qty; ?>
        @endforeach
        </div>
        <div class="col-md-12">
          <div style="float:left;width:56%;text-align:right;">
            <span style="font-size:12px;">Sub Total</span>
          </div>
          <div style="float:left;width:43%;text-align:center;">
            <span style="font-size:12px;">{{$subtotal}}</span>
          </div>
        </div>
        <div class="col-md-12">
          <div style="float:left;width:56%;text-align:right;">
            <span style="font-size:12px;">Number of Items</span>
          </div>
          <div style="float:left;width:43%;text-align:center;">
            <span style="font-size:12px;">{{ $qty }}</span>
          </div>
        </div>
        <div class="col-md-12">
            <a class="btn btn-primary pull-right" id="print" onclick="printDiv('printableArea')" ><i class="fa fa-print"></i>Print invoice</a>
          </div>
     </div>
     
</div> 
  <script type="text/javascript">
     function printDiv(divName) {
       var printContents = document.getElementById(divName).innerHTML;
       var originalContents = document.body.innerHTML;
       
       document.body.innerHTML = printContents;
       var printButton = document.getElementById("print");
       printButton.style.visibility = "hidden";
       window.print();
       printButton.style.visibility = "visible";
       document.body.innerHTML = originalContents;
  }
   </script>
@stop
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"></script>
@stop
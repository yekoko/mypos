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
<div class="container-fluid" id="printableArea">
     <div class="row">
        <div class="col-md-12">
          <h4 style="text-align:center;">My Own Shop</h4>
          <h4 style="text-align:center;">My Own Shop</h4>
          <h4 style="text-align:center;">My Own Shop</h4>
        </div>
       
        <div class="col-md-12" style="border-bottom:1px solid #333;">
          <span style="width:49%;font-size:20px;">Sales Receipt</span>
          <span style="width:49%;font-size:20px;float:right;text-align:right;"><?php echo(date("d/m/Y h:i:sa")); ?></span>
           
        </div>
          <div class="col-md-12" style="text-align:center;border-bottom:1px solid #333;">
            <span style="width:49%;font-size:20px;text-align:right;">Customer Name :</span>
            <span style="width:49%;font-size:20px;text-align:left;">{{ $customer }}</span>
          </div>
          
         <?php $qty = 0; ?>
        <div class="col-md-12">
          <div style="float:left;width:25%;">
            <h4 style="text-align:left;">Name</h4>
          </div>
          <div style="float:left;width:25%;">
            <h4 style="text-align:left;">Price</h4>
          </div>
          <div style="float:left;width:25%;">
            <h4 style="text-align:left;">Quantity</h4>
          </div>
          <div style="float:left;width:25%;">
            <h4 style="text-align:left;">Total</h4>
          </div>
        </div>
        <div class="col-xs-12" style="border-bottom:1px solid #333;">
        @foreach($shoppingcart as $value)
          <div style="float:left;width:25%;">
            <h4 style="text-align:left;">{{$value->name}}</h4>
          </div>
          <div style="float:left;width:25%;">
            <h4 style="text-align:left;">{{$value->price}}</h4>
          </div>
          <div style="float:left;width:25%;">
            <h4 style="text-align:left;">{{$value->qty}}</h4>
          </div>
          <div style="float:left;width:25%;">
            <h4 style="text-align:left;">{{$value->subtotal}}</h4>
          </div>
          <?php $qty += $value->qty; ?>
        @endforeach
        </div>
        <div class="col-md-12">
          <div style="float:left;width:56%;">
            <h4 style="text-align:right;">Sub Total</h4>
          </div>
          <div style="float:left;width:43%;">
            <h4 style="text-align:center;">{{$subtotal}}</h4>
          </div>
        </div>
        <div class="col-md-12">
          <div style="float:left;width:56%;">
            <h4 style="text-align:right;">Number of Items</h4>
          </div>
          <div style="float:left;width:43%;">
            <h4 style="text-align:center;">{{ $qty }}</h4>
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
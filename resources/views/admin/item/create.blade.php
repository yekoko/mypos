@extends('admin.layout.default')
@section('title')
Item
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
    <h1>Item</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Item</li>
        <li class="active">Item</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"> <i class="livicon" data-name="list" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create Item
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-6 col-md-offset-3">
                        <form class="form-horizontal" action="{{ route('item.store') }}" method="post">
                            {{ csrf_field() }}
                             <p>
                                <label for="name" class="control-label">Name</label>
                                <input type="text" name="name" class="form-control"/>
                                 <div class="errors">
                                    {{ $errors->first('name') }}    
                                </div>
                             </p>
                             <p>
                                <label for="price" class="control-label">Price</label>
                                <input type="text" name="price" class="form-control"/>
                                 <div class="errors">
                                    {{ $errors->first('price') }}    
                                </div>
                             </p>
                             <p>
                                <label for="quantity" class="control-label">Quantity</label>
                                <input type="text" name="quantity" class="form-control"/>
                                 <div class="errors">
                                    {{ $errors->first('quantity') }}    
                                </div>
                             </p>                                   
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a class="btn btn-primary" href="{{ route('item.index') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</section>
@stop
@section('footer_scripts')
	
    <script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"></script>
@stop
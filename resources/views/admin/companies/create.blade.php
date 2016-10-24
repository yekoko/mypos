@extends('admin.layout.default')
@section('title')
Create Company
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
    <h1>Company</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Company</li>
        <li class="active">Create Company</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="users-add" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create Company
                    </h4>
                </div>
                <div class="panel-body">
                	<div class="alert-danger">
						 {{ $errors->first('message') }}
					</div>
					<div class="col-md-6 col-md-offset-3">
						<form class="form-horizontal"  action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="pic" class="col-sm-2 control-label">Company Logo</label>
                                <div class="col-sm-10">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                            <img src="http://placehold.it/200x200" alt="profile pic">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                        <div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input id="pic" name="pic" type="file" class="form-control" />
                                            </span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
							 <p>
								<label for="name" class="control-label">name</label>
								<input type="text" name="name" class="form-control"/>
								<div class="errors">
									{{ $errors->first('name') }}	
								</div>	 			
							 </p>
                             <p>
                                <label for="address" class="control-label">Address</label>
                                <input type="text" name="address" class="form-control"/>
                                <div class="errors">
                                    {{ $errors->first('address') }}    
                                </div>              
                             </p>
                             <p>
                                <label for="phone" class="control-label">Phone</label>
                                <input type="text" name="phone" class="form-control"/>
                                <div class="errors">
                                    {{ $errors->first('phone') }}    
                                </div>              
                             </p>
                             <p>
                                 <label for="industry" class="control-label">Industry</label>                                
                                <select class="form-control" name="industry">
                                    <option value="">Select Industry</option>
                                    @foreach($industries as $industry)    
                                        <option value={{ $industry->id }}>{{$industry->name}}</option>
                                    @endforeach        
                                </select>
                                <div class="errors">
                                    {{ $errors->first('industry') }}    
                                </div>  
                             </p>
                             <p>
                                <label for="company_size" class="control-label">Company Size</label>
                                <input type="text" name="company_size" class="form-control" placeholder="10-50 employees" />
                                <div class="errors">
                                    {{ $errors->first('company_size') }}    
                                </div>              
                             </p>
                             <p>
                                <label for="registration_no" class="control-label">Registration No</label>
                                <input type="text" name="registration_no" class="form-control"/>
                                <div class="errors">
                                    {{ $errors->first('registration_no') }}    
                                </div>              
                             </p>
                             <p>
                                <label for="website_link" class="control-label">Website(or)Facebook Link</label>
                                <input type="text" name="website_link" class="form-control"/>
                                <div class="errors">
                                    {{ $errors->first('website_link') }}    
                                </div>              
                             </p>
                             <p>
                                <label for="working_hour" class="control-label">Working Hour</label>
                                <input type="text" name="working_hour" class="form-control" placeholder="Mon-Fri 9am to 6pm" />
                                <div class="errors">
                                    {{ $errors->first('working_hour') }}    
                                </div>              
                             </p>
                             <p>
                                <label for="overview" class="control-label">Overview</label>
                                <input type="text" name="overview" class="form-control"/>
                                <div class="errors">
                                    {{ $errors->first('overview') }}    
                                </div>              
                             </p>
							<button type="submit" class="btn btn-primary">Create</button>
							<a class="btn btn-primary" href="{{ route('company.index') }}">Cancel</a>
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
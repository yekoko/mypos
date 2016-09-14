@extends('admin.layout.default')
@section('title')
Create User
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
    <h1>User</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>User</li>
        <li class="active">Create User</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="users-add" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create User
                    </h4>
                </div>
                <div class="panel-body">
                	<div class="alert-danger">
						 {{ $errors->first('message') }}
					</div>
					<div class="col-md-6 col-md-offset-3">
						<form class="form-horizontal"  action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
							 {{ csrf_field() }}
							 <p>
								<label for="name" class="control-label">name</label>
								<input type="text" name="name" class="form-control"/>
								<div class="errors">
									{{ $errors->first('name') }}	
								</div>	 			
							 </p>
							 <p>
								<label for="email" class="control-label">Email</label>
								<input type="text" name="email" class="form-control"/>
								<div class="errors">
									{{ $errors->first('email') }}	
								</div>					 			
							 </p>
							 <p>
								<label for="password" class="control-label">Password</label>
								<input type="text" name="password" class="form-control"/>
								 <div class="errors">
									{{ $errors->first('password') }}	
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
								<label for="role" class="control-label">Role</label>								 
								<select class="form-control" name="role">
									<option value="">Select Role</option>
									@foreach($roles as $role)	 
								  		<option value={{ $role->id }}>{{$role->slug}}</option>}
								   	@endforeach		   
								</select>
								<div class="errors">
									{{ $errors->first('role') }}	
								</div> 								 			
							 </p>
							  
							<button type="submit" class="btn btn-primary">Create</button>
							<a class="btn btn-primary" href="{{ route('user.index') }}">Cancel</a>
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
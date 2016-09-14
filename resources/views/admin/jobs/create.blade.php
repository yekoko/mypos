@extends('admin.layout.default')
@section('title')
Create Job
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
    <h1>Job</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Job</li>
        <li class="active">Create Job</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="users-add" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create Job
                    </h4>
                </div>
                <div class="panel-body">
                	<div class="alert-danger">
						 {{ $errors->first('message') }}
					</div>
					<div class="col-md-6 col-md-offset-3">
						<form class="form-horizontal"  action="{{ route('job.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
							 <p>
								<label for="title" class="control-label">Title</label>
								<input type="text" name="title" class="form-control" placeholder="Web Developer (PHP)" />
								<div class="errors">
									{{ $errors->first('title') }}	
								</div>	 			
							 </p>
                             <p>
                                 <label for="category" class="control-label">Category</label>                                
                                <select class="form-control" name="category">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)    
                                        <option value={{ $category->id }}>{{$category->name}}</option>
                                    @endforeach        
                                </select>
                                <div class="errors">
                                    {{ $errors->first('category') }}    
                                </div>  
                             </p>
                             <p>
                                 <label for="experience" class="control-label">Experience</label>                                
                                <select class="form-control" name="experience">
                                    <option value="">Select Experience</option>
                                    @foreach($experiences as $experience)    
                                        <option value={{ $experience->id }}>{{$experience->name}}</option>
                                    @endforeach        
                                </select>
                                <div class="errors">
                                    {{ $errors->first('experience') }}    
                                </div>  
                             </p>
                             <p>
                                <label for="salary" class="control-label">Salary</label>
                                <input type="text" name="salary" class="form-control" placeholder="200000-400000" />
                                <div class="errors">
                                    {{ $errors->first('salary') }}   
                                </div>              
                             </p>
                             <p>
                                <label for="requirement" class="control-label">Requirement</label>
                                <textarea name="requirement" class="form-control" placeholder="Developed Software Design for the solution and review with the team"></textarea>
                                <div class="errors">
                                    {{ $errors->first('requirement') }}   
                                </div>              
                             </p>
                             <p>
                                <label for="responsibilities" class="control-label">Responsibility</label>
                                <textarea name="responsibilities" class="form-control" placeholder="Understand requirement coming from business users or representative ,presented as Users Stories"></textarea>
                                <div class="errors">
                                    {{ $errors->first('responsibilities') }}   
                                </div>              
                             </p>
                             <p>
                                <label for="description" class="control-label">Description</label>
                                <textarea name="description" class="form-control" placeholder="Understand requirements coming from business"></textarea>
                                <div class="errors">
                                    {{ $errors->first('description') }}   
                                </div>              
                             </p>
                             <p>
                                <label for="email" class="control-label">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="myemail@gmail.com" />
                                <div class="errors">
                                    {{ $errors->first('email') }}   
                                </div>              
                             </p>
                             <p>
                                <label for="phone" class="control-label">Phone No</label>
                                <input type="text" name="phone" class="form-control" placeholder="09799999999,01525252" />
                                <div class="errors">
                                    {{ $errors->first('phone') }}   
                                </div>              
                             </p>
                             <p>
                                <label for="address" class="control-label">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="no,11,Main Street,Hlaing Township" />
                                <div class="errors">
                                    {{ $errors->first('address') }}   
                                </div>              
                             </p>
							<button type="submit" class="btn btn-primary">Create</button>
							<a class="btn btn-primary" href="{{ route('job.index') }}">Cancel</a>
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
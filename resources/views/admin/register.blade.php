@extends ('admin.layout.default')

@section('content')
	<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Register Page</h3>
					</div>
					<div class="panel-body">
						<div class="alert-danger">
						 {{ $errors->first('message') }}
						</div>
						<form class="form-horizontal" method="post">
						 
						<?php echo csrf_field(); ?>
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
							<button type="submit" class="btn btn-primary">Register</button>
							 
						</form>
					</div>
				</div>
@stop
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title></title>
 	<link rel="stylesheet" href="">
 	<script src="/assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="/assets/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
 </head>
 <body>
	 <div class="row">
	 	<div class="col-md-4">
	 	</div>

	 	<div class="col-md-4">
	 		<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Forgot-password</h3>
				</div>
				<div class="panel-body" id="login">
					<div class="alert-danger">
						{{ $errors->first('message') }}
					</div>
					<div class="reset">
						<form class="form-horizontal" method="post" action="{{route('forgot-password')}}">
							<h5>
		     					Enter your email address and we will send you a link to reset your password.
							</h5>
								<p>
									<label for="email" class="control-label">Email</label>
										<input type="text" name="email" class="form-control"/>
									<div class="errors">
										{{ $errors->first('email') }}	
									</div>								 			
								</p>							  
								<button type="submit" class="btn btn-primary">Reset</button>
								<a class="btn btn-primary" href="{{ route('login') }}">Cancel</a>
						</form>
					</div>
				</div>
			</div>
	 	</div>
	 	<div class="col-md-4">
	 		
	 	</div>
	 	
	 </div>
 </body>
 </html>
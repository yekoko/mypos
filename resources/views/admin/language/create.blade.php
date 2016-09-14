@extends ('admin.layout.default')
@section('title')
Create Role
@stop
@section('content')
<section class="content-header">
    <h1>Language</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Language</li>
        <li class="active">Create Language</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="users-add" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create Language
                    </h4>
                </div>
                <div class="panel-body">
                	<div class="alert-danger">
						 {{ $errors->first('errors') }}
					</div>
					<div class="col-md-6 col-md-offset-3">
						<form class="form-horizontal" action="{{ route('admin.language.store') }}" method="post">
							 <p>
								<label for="name" class="control-label">Name</label>
								<input type="text" name="name" class="form-control"/>
								 <div class="errors">
									{{ $errors->first('name') }}	
								</div>
							 </p>
							  						  
							<button type="submit" class="btn btn-primary">Create</button>
							<a class="btn btn-primary" href="{{ route('admin.language.index') }}">Cancel</a>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
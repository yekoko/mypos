@extends ('admin.layout.default')
@section('title')
Edit Item
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
        <li class="active">Edit Item</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="users-add" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit Item
                    </h4>
                </div>
                <div class="panel-body">
                	
					<div class="col-md-6 col-md-offset-3">
						<form class="form-horizontal" action="{{ route('item.update',$item->id) }}" method="post">
                        {{ csrf_field() }}
							 <input name="_method" type="hidden" value="PUT">
                             <p>
								<label for="name" class="control-label">Name</label>
								<input type="text" name="name" class="form-control" value="{{$item->name}}"/>
								 <div class="errors">
									{{ $errors->first('name') }}	
								</div>
							 </p>
							 <p>
								<label for="price" class="control-label">Price</label>
								<input type="text" name="price" class="form-control" value="{{$item->price}}"/>
								 <div class="errors">
									{{ $errors->first('price') }}	
								</div>
							 </p>		
                             <p>
                                <label for="quantity" class="control-label">Quantity</label>
                                <input type="text" name="quantity" class="form-control" value="{{$item->quantity}}"/>
                                 <div class="errors">
                                    {{ $errors->first('quantity') }}   
                                </div>
                             </p>       					  
							<button type="submit" class="btn btn-primary">Update</button>
							<a class="btn btn-primary" href="{{ route('item.index') }}">Cancel</a>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
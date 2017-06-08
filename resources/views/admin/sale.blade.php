@extends('admin.layout.default')
@section('title')
Sale Panel
@stop
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<style>
    .search_component{
        display:flex;
        flex-direction: column;
        width: 100%;
        justify-content: center;
        align-items: center;
    }
    .search_component input {
        border : 1px transparent;
    }
    .search_results {
        list-style-type: none;
        background:white;
        padding-left: 0px;
        margin-top: 5px;
      
    }
    .single_search_result {
          border-bottom: 2px solid #eeeeee;
          padding:10px;
    }
    .single_search_result:hover {
        background: #eee;
        cursor : pointer;
    }
    .store_name {
        font-weight: bolder;
    }
</style>
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
<section class="content">
    <div class="row" id="app">
        <div class="col-lg-8" style="padding-right: 0;">
        	<div class="panel panel-primary" style="margin-bottom: 5px;">
                <div class="panel-body">
	                <div class="input-group">
						  <input type="text" class="form-control" placeholder="Enter item name or scan barcode" aria-describedby="basic-addon2" v-model="search_query" class="search-input" @keyup="ExecuteSearch" >
						  <span class="input-group-addon" id="basic-addon2">Search</span>
					</div>
					<div>
			            <ul class="search_results">
			                <li class="single_search_result" v-for="store in stores" @click="FindItem(store.id)" style="border:1px solid #eee">   
			                	<span class="store_name">@{{ store.name }} </span>
			                </li>
			            </ul>
			        </div>
	            </div>
            </div>
            <div class="panel panel-primary" >
                <div class="panel-heading">                    
                        Sale
                    </h4>
                </div>
                 <div class="panel-body" >
                 	<div class="table-responsive">
					  <table class="table">
					  	<thead>
                            <tr>
                                <th>No</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>   
                                <th>Delete</th>                        
                            </tr>
                        </thead>
                        <tbody>                             
                             <tr v-for="item in items">
                                <td>@{{ item.id }} </td>
                                <td>@{{ item.name }}</td>
                                <td>@{{ item.price }}</td>
                                <td><input @keyup.enter="editqty(item)" type="text" name="" v-model="item.qty"></td>
                                <td>@{{ item.subtotal }}</td>
                                <td>
                                    <button class="btn-danger" @click="deletesalebyid(item.id)">Delete</button>
                                </td>

                             </tr>                            
                        </tbody>
					  </table>
					</div>	
                 </div>
            </div>
        </div>
        <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                  </div>
                  <div class="modal-body">
                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="editqty">Save changes</button>
                  </div>
                </div>
              </div>
        </div> -->
        <div class="col-lg-4">
            <div class="panel panel-primary " style="margin-bottom: 5px;">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="users-add" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Customer
                    </h4>
                </div>
                 <div class="panel-body">
                 <form id="btn_complete" class="form-horizontal" action="{{ route('completesale') }}" method="post">
                    {{ csrf_field() }}
                 	<div class="input-group">
					  <span class="input-group-addon" id="sizing-addon2"><i class="livicon" data-name="users-add" data-size="16" data-loop="true"></i></span>
					  <input name="customer" type="text" class="form-control" placeholder="Type customer name" aria-describedby="sizing-addon2">
					</div>
                    </form>
                 </div>
            </div>
            <div style="background: white;">
            	<ul class="list-group" style="margin-bottom: 20px;">
				 <li class="list-group-item" style="border: none;">
				 	<div style="max-width: 80%;display: inline-block;">
				 		Discount all Items by Percent:
				 	</div>
				 	<div style="float: right;">
				 		10%
				 	</div>
				 </li>
				 <li class="list-group-item" style="border: none;">
					<div style="max-width: 80%;display: inline-block;">
				 		Discount all Items by Percent:
				 	</div>
				 	<div style="float: right;">
				 		10%
				 	</div>
				 </li>
				 <li class="list-group-item list-group-item-success" style="border: none;">
				 	<div style="max-width: 80%;display: inline-block;">
				 		Sub Total:
				 	</div>
				 	<div style="float: right;">
				 		@{{ subtotal }}
				 	</div>
				 </li>
			</ul>
			<div style="height:70px;border-top:1px dashed #D0D3D8;border-bottom:1px dashed #D0D3D8;">
				<div style="width:49%;padding:10px;height:68px;display:inline-block;border-right:1px dashed #D0D3D8;">
					<div>
						Total
					</div>
					<div>
						@{{ subtotal }}
					</div>
				</div>
				<div style="width:49%;padding:10px;height:68px;display:inline-block;">
					<div>
						Total
					</div>
					<div>
						$0.00
					</div>
				</div>
			</div>
			<div style="height:100px;margin-top:20px;">
                <div class="col-md-6">
                    <button class="btn-danger" @click="deletesale">Sale Cancel</button>
                </div>
				<div class="col-md-6" style="float:right;">
                    <button class="btn-success" form="btn_complete">Complete Sale</button>
                </div>
			</div>
            </div>
            
			
        </div>

    </div>
</section> 
<!-- <script src="https://unpkg.com/vue"></script> -->
<script src="../js/axios.min.js"></script>
<script src="../js/vue.js"></script>
<script type="text/javascript">
	var app = new Vue({
	  el: '#app',
	  data: {
	    
           	search_query : '',
            stores : '',
            items : '',
            subtotal : '',
            qty : '',
            showResults : false,
            
	  },
      mounted()
      {
        var VueInstance = this;
            axios.get('/cartitem')
                 .then(function (response) {
                           VueInstance.items = response.data.item;
                           VueInstance.subtotal = response.data.subtotal;
                        })
      },
	  methods : {
            ExecuteSearch : function () {
                 var VueInstance = this;
                 axios.post('/searchitem', {
                        search_query: VueInstance.search_query
                    })
                        .then(function (response) {
                           VueInstance.stores = response.data.stores;


                        })
                        .catch(function (error) {

                        });
                   
            },
            FindItem : function(id) {
                var VueInstance = this;
                 axios.get('/searchitembyid/'+id)
                        .then(function (response) {
                           VueInstance.items = response.data.item;
                           VueInstance.subtotal = response.data.subtotal;
                           VueInstance.search_query = '';
                           VueInstance.stores = '';
                        })
                        .catch(function (error) {

                        });
            },
            deletesalebyid : function(id) {
                var VueInstance = this;
                 axios.delete('/deletesalebyid/'+id)
                        .then(function (response) {
                           VueInstance.items = response.data.item;
                           VueInstance.subtotal = response.data.subtotal;
                        })
            },
            deletesale : function() {
                var VueInstance = this;
                axios.delete('/deletesale')
                        .then(function (response) {
                           VueInstance.items = response.data.item;
                        })
            },
            editqty : function(item) {
                var VueInstance = this;
                axios.put('/editqty/'+item.id, {
                        qty: item.qty
                    })
                        .then(function (response) {
                            VueInstance.items = response.data.item;
                            VueInstance.subtotal = response.data.subtotal;

                        })
                        .catch(function (error) {

                        });
                
            }
        }
	})
</script>
@stop
@section('footer_scripts')
	
    <script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"></script>
@stop
@extends('layouts.site.layout')
@section('content')
  <!-- header -->
  @include('layouts.site.header')
	<section id="advertisement">
		<div class="container">
			<div class="col-sm-3">
				<select id="sortBy">
					<option value="">Default</option>
					<option value="Newest">Newest First</option>
					<option value="Price:Low to High"	>Price:Low to High</option>
					<option value="Price:High to Low">Price:High to Low</option>
				</select>
			</div>
		</div>
	</section>	
	<section>
		<div class="container">
			@if($message = Session::get('flash_message_error')) 
	            <div class="alert alert-info alert-danger" role="alert">
	                <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
	                {{ $message }}
	            </div>
	        @endif
	        @if($message = Session::get('flash_message_success')) 
	            <div class="alert alert-success alert-dismissible" role="alert">
	                <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
	                {{ $message }}
	            </div>
	        @endif
			<div class="row">
				<div class="col-sm-3">
		          <div class="left-sidebar">
		            <h2>Category</h2>
		            <div class="panel-group category-products"><!--category-products-->
		            @foreach($categories as $cat)
		              <div class="panel panel-default">
		                  <div class="panel-heading">
		                    <form method="post" action="{{ route('display.product',$cat->id) }}">
		                      @csrf
		                          <h4 class="panel-title">
		                            <input type="hidden" name="category_id" value="{{$cat->id}}">
		                            <input type="submit" class="input-submit" value=" {{$cat->category}} ({{ $cat->products->count() }})" />
		                          </h4>
		                  	</form>
		                   </div>
		               </div>
		            @endforeach
		            </div><!--/category-products-->
		          </div>
        		</div>
				<div class="col-sm-9 padding-right"  id="sort_data"> </div>
			</div>
		</div>
	</section>
	<!-- footer -->
  @include('layouts.site.footer')
@endsection
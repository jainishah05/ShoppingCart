@if(isset($categoryProduct))
	<div class="features_items">
		<h2 class="title text-center">{{ $categoryProduct[0]->category }}</h2>
		@foreach($categoryProduct as $pro)
		<div class="col-sm-4">
			<div class="product-image-wrapper">
				<div class="single-products">
					<div class="productinfo text-center">
						@foreach($pro->product_images as $img)
							<img src="{{ url('../uploads/productimages/'.$img->image) }}" alt="" style="width: 60%" height="200" />
							@break
						@endforeach
						<h2>{{ $pro->price }}</h2>
						<p>{{ $pro->name }}</p>
						<a href="{{url('/product/'.$pro->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
					</div>
				</div>
				<div class="choose">
					<ul class="nav nav-pills nav-justified">
						<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
						<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
					</ul>
				</div>
			</div>
		</div>
		@endforeach
		{{ $categoryProduct->links() }} 
	</div>
@else
	<div class="col-sm-12">
		<div class="features_items">
			<h2 class="title text-center">All Products</h2>	
				@foreach($products as $pro)
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									@foreach($pro->product_images as $img)
										<img src="{{ url('../uploads/productimages/'.$img->image) }}" alt="" style="width: 60%" height="200" />
										@break
									@endforeach
									<h2>{{ $pro->price }}</h2>
									<p>{{ $pro->name }}</p>
									<a href="{{url('/product/'.$pro->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								<div class="product-overlay">
									<div class="overlay-content">
										<h2>{{ $pro->price }}</h2>
										<p>{{ $pro->name }}</p>
										<a href="{{url('/product/'.$pro->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
								</div>
							</div>
						<div class="choose">
							<ul class="nav nav-pills nav-justified">
								<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
								<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
							</ul>
						</div>
					</div>
				</div>
				@endforeach
				{{-- The links method will render/provide the links to the rest of the pages in the result set. Each of these links will already contain the proper page query string variable. --}}
		</div><!--features_items-->
		{{-- pagination --}}
		{{ $products->links() }} 
	</div>
@endif

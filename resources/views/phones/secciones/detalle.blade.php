<section class="pt-5 pb-5">
	<div class="container">
		<div class="row">
			
			@foreach ($models as $model)
			<div class="col-sm-4">
				<div id="phone{{$model->id}}" class="d-sm-flex justify-content-center align-items-center flex-column m-2">
					<a href="{{route('model.shop' , ['id' => $model->id])}}">
						<div 
						style="min-width: 135px; 
						height:135px; 
						background-image: url({{asset('storage')}}/{{$model->thumbnail}});
						background-size: contain;
						background-position: center center;
						background-repeat: no-repeat;
						border-radius:10px;">
						</div>  
					</a>
					<a class="pt-2 pb-2 text-dark" href="{{route('model.shop' , ['id' => $model->id])}}" >{{$model->name}}</a>	
				</div>
			</div>
			@endforeach
		</div>
		<div class="row pt-3">
			<div class="col">
				{{ $models->links('pagination::bootstrap-5') }}
			</div>
		</div>
	</div>
</section>

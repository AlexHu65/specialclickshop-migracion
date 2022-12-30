<section class="pt-5 pb-5">
	<div class="container">
		<div class="row">
			@foreach ($models as $model)
			<div class="col-sm-3 mt-3">
				<div class="card">
					<div class="card-body d-flex justify-content-center flex-column align-items-center">
					    <a href="{{route('model.shop' , ['id' => $model->id])}}"><img class="card-img-top" src="{{asset('storage')}}/{{$model->thumbnail}}" alt="{{$model->name}}"></a>
						<a href="{{route('model.shop' , ['id' => $model->id])}}" class="btn-hover color-10">{{$model->name}}</a>
					</div>
				  </div>
			</div>
			@endforeach
			
		</div>
		<div class="row pt-3">
			<div class="col">
				{{ $models->links() }}
			</div>
		</div>
	</div>
</section>

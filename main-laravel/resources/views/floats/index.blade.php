@extends('app')

@section('title')
  Featured deals
@endsection

@section('content')

  <div class="container">
    <h1>All Floats</h1>
    <div class="separator-2"></div>

    <ul class="nav nav-pills" role="tablist" style="display: none">
			<li class="active"><a href="#pill-1" role="tab" data-toggle="tab" title="Latest Arrivals" aria-expanded="true"><i class="icon-star"></i> All Deals</a></li>
			<li class=""><a href="#pill-2" role="tab" data-toggle="tab" title="Featured" aria-expanded="false"><i class="icon-heart"></i> Featured</a></li>
			<li class=""><a href="#pill-3" role="tab" data-toggle="tab" title="Top Sellers" aria-expanded="false"><i class=" icon-up-1"></i> Top Sellers</a></li>
		</ul>

    <div class="tab-content clear-style">
			<div class="tab-pane active" id="pill-1">
				<div class="row masonry-grid-fitrows grid-space-10">
          @foreach ($deals as $deal)
            <div class="col-md-3 col-sm-6 masonry-grid-item">
						  <div class="listing-item white-bg bordered mb-20">
							  <div class="overlay-container">
								  <img src="{{ asset($deal->image_path) }}" alt="{{ $deal->name }}">
								  <a class="overlay-link" href="{{ url('float', $deal) }}"><i class="fa fa-arrow-right"></i></a>
								  <span class="badge">NEW</span>
							  </div>
							  <div class="body">
								  <h3><a href="{{ url('float', $deal) }}">{{ $deal->name }}</a></h3>
								  <p class="small" style="display: none;">{{ str_limit($deal->description, 100) }}.</p>
								  <div class="elements-list clearfix">
									  <span class="price">{{ money_format('$%i', $deal->price) }}</span>
									  <a href="{{ url('float', $deal) }}" class="pull-right margin-clear btn btn-sm btn-default btn-animated">I want this <i class="fa fa-arrow-right"></i></a>
								  </div>
							  </div>
						  </div>
					  </div>
          @endforeach
				</div>
			</div>
		</div>

    <nav class="text-center" style="display: none">
			<ul class="pagination">
				<li><a href="#" aria-label="Previous"><i class="fa fa-angle-left"></i></a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#" aria-label="Next"><i class="fa fa-angle-right"></i></a></li>
			</ul>
		</nav>

	</div>

@endsection

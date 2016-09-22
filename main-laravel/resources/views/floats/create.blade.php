@extends('app')

@section('title')
  Creating a new float
@endsection

@section('content')
  <div class="container">
    <div class="col-md-12">
      <h1 class="text-center">Creating a new float</h1>
      <div class="separator-2"></div>

			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

      <div class="row">
        <div class="col-md-6">
          <h3 class="text-center">Upload your own product</h3>

          {!! Form::open(
              array(
                  'route' => 'adddeal',
                  'class' => 'form',
                  'novalidate' => 'novalidate',
                  'files' => true)) !!}

          <div class="form-group">
            {!! Form::label('Float title') !!}
            {!! Form::text('name', null, array('class' => 'form-control')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('Float description') !!}
            {!! Form::textarea('description', null, array('class' => 'form-control', 'rows' => "4")) !!}
          </div>

          <div class="form-group row">
            <div class="col-md-4">
              {!! Form::label('Float Type') !!}
              {!! Form::select('type',
                  array(
                      ''  => '-- Select One --',
                      '0' => 'Open',
                      '1' => 'Invitation Only'
                  ), '', array('class' => 'form-control')); !!}
            </div>
            <div class="col-md-4">
              {!! Form::label('Price') !!}
              {!! Form::text('price', null, array('class' => 'form-control')) !!}
            </div>
            <div class="col-md-4">
              {!! Form::label('Ods') !!}
              {!! Form::text('ods', null, array('class' => 'form-control')) !!}
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-6">
              {!! Form::label('Start Date') !!}
              {!! Form::date('start_date', \Carbon\Carbon::now(), array('class' => 'form-control')); !!}
            </div>
            <div class="col-md-6">
              {!! Form::label('End Date') !!}
              {!! Form::date('end_date', \Carbon\Carbon::now()->addWeek(), array('class' => 'form-control')); !!}
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-6">
            {!! Form::label('Product Image') !!}
            {!! Form::file('image', null, array('class' => 'form-control')) !!}
            </div>
          </div>

          <div class="form-group text-center">
            {!! Form::submit('Create Float', array('class' => 'btn btn-default')) !!}
          </div>

          {!! Form::close() !!}
        </div>

        <div class="col-md-6">
          <h3 class="text-center">or start a float with a product from our list</h3>
          <br />

          @foreach ($products as $product)
          <div class="listing-item bordered light-gray-bg mb-10">
						<div class="row grid-space-0">
							<div class="col-sm-4 col-md-3 col-lg-2">
								<div class="overlay-container thumb">
									<img src="{{ asset($product->image_path) }}" alt="">
								</div>
							</div>
							<div class="col-sm-8 col-md-9 col-lg-10">
								<div class="body">
									<h3 class="margin-clear">{{ $product->name }}</h3>
									<p class="small">{{ str_limit($product->description, 100) }}</p>

									<div class="elements-list clearfix">
										<span class="price">{{ money_format('$%.2n', round($product->price, 2)) }}</span>

										<a href="{{ url('float/create-from-product', $product) }}" class="pull-right btn btn-sm btn-default btn-animated">Float this<i class="fa fa-arrow-right"></i></a>

									</div>
								</div>
							</div>
						</div>
					</div>
          @endforeach

          <p class="text-center"><a href="#">See all available products</a></p>

        </div>
      </div>
    </div>

@endsection

@extends('app')

@section('title')
  Update & confirm the following information
@endsection

@section('content')
  <div class="container" id="float-details">

    <h1>{{ $product->name }}</h1>
    <div class="separator-2"></div>

    <div class="row">
      <div class="col-md-4 pv-20 float-image">
        <img  src="{{ asset($product->image_path) }}" />
      </div>
      <div class="col-md-8">
        <h2>Update & confirm the following information</h2>

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

        {!! Form::open(
            array(
                'route' => 'addfromproduct',
                'class' => 'form',
                'novalidate' => 'novalidate',
                'files' => true)) !!}

        {!! Form::hidden('product_id', $product->id) !!}

        <div class="form-group">
          {!! Form::label('Float title') !!}
          {!! Form::text('name', $product->name, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
          {!! Form::label('Float description') !!}
          {!! Form::textarea('description', $product->description, array('class' => 'form-control', 'rows' => "4")) !!}
        </div>

        <div class="form-group row">
          <div class="col-md-4">
            {!! Form::label('Float Type') !!}
            {!! Form::select('type',
                array(
                    ''  => '-- Select One --',
                    '0' => 'Open',
                    '1' => 'Invitation Only'
                ), 'S', array('class' => 'form-control')); !!}
          </div>
          <div class="col-md-4">
            {!! Form::label('Price') !!}
            <p class="form-control-static">{{ money_format('$%i', $product->price)  }}</p>
            {!! Form::hidden('price', $product->price, null) !!}
          </div>
          <div class="col-md-4">
            {!! Form::label('Ods') !!}
            {!! Form::text('ods', 0, array('class' => 'form-control')) !!}
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
          <div class="col-md-12">
            <div class="alert alert-info">
              You will be required to pay.
            </div>
          </div>
        </div>

        <div class="form-group text-center">
          {!! Form::submit('Create Float', array('class' => 'btn btn-default')) !!}
          <a href="javascript:history.back()" class="btn btn-link">Cancel</a>
        </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@endsection

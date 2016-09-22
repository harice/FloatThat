@extends('app')

@section('title')
  Please confirm your information
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Registering a new user - Please confirm all your information.</div>
				<div class="panel-body">
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

					<form class="form-horizontal" role="form"
                method="POST" action="{{ url('/user/confirm/save') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

            @if (isset($twitter_provider_id))
              <input type="hidden" name="twitter_provider_id"
                     value="{{ $twitter_provider_id }}">
            @endif
            @if (isset($facebook_provider_id))
              <input type="hidden" name="facebook_provider_id"
                     value="{{ $facebook_provider_id }}">
            @endif

            <div class="form-group">
							<label class="col-md-4 control-label">Picture</label>
							<div class="col-md-6">
                <input type="hidden" name="avatar" value="{{ $avatar }}" />
                <img src="{{ $avatar }}" width="80" />
							</div>
						</div>

            @if (isset($twitter_nickname))
              <div class="form-group">
							  <label class="col-md-4 control-label">Twitter Username</label>
							  <div class="col-md-6">
                  <p class="form-control-static">&#64;{{ $twitter_nickname }}</p>
							  </div>
						  </div>
            @endif

            <div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ $name }}">
							</div>
						</div>

            <div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ $email }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-group btn-default btn-animated">Confirm & Register <i class="fa fa-envelope"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

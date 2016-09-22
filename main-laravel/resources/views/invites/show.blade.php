@extends('app')

@section('content')
  <div class="container text-center" id="invite-accept">

    @if (session('error'))
      <div class="alert alert-icon alert-danger" role="alert">
		    <i class="fa fa-times"></i>
		    {{ session('error') }}
	    </div>
    @endif


    <h1 class="text-center">
      {{ $deal->name }}, valued {{ money_format('$%i', $deal->price) }}
    </h1>

    <img width="500" src="{{ asset($deal->image_path) }}" alt="{{ $deal->name }}">
    <br />
    <p>
      {{ $deal->description }}
    </p>
    <hr />

    <h3>
      Your friend <strong>{{ $host->name }}</strong> has sent you a chance of winning.
    </h3>

    <p>
      <strong>
        You have a 1 in {{ $deal->ods }} chances of winning this deal for {{ money_format('$%i', round($deal->price/$deal->ods, 2)) }}.
      </strong>
    </p>


    <div class="actions">
      <a href="{{ url('invite/accept', $deal) }}/?code={{ $invite->code }}&email={{ $invite->email_address }}" class="btn btn-animated btn-lg btn-default">Accept Invite <i class="fa fa-check"></i></a>
      <a href="#" class="btn btn-animated btn-lg btn-danger">Decline <i class="fa fa-times"></i></a>
    </div>

  </div>
@endsection

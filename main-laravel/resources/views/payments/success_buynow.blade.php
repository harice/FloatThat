@extends('app')

@section('content')
  <div class="container" id="float-details">

    <div class="row">
	    <div class="main col-md-6 col-md-offset-3 pv-40">
		    <h1 class="page-title"><span class="text-default">Thank you for your payment</span></h1>
		    <h2>You just bought {{ $deal->name }}</h2>

        <p>
          Congratulations, your payment has been approved we've sent a receipt to your email address.
        </p>

		    <a href="{{ url("float", $payment->float_id) }}" class="btn btn-default btn-animated btn-lg">Go to deal page <i class="fa fa-check"></i></a>
	    </div>
	    <!-- main end -->

    </div>
  </div>
@endsection

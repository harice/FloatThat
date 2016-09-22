@extends('app')

@section('content')
  <div class="container" id="float-details">

    <div class="row">

	    <!-- main start -->
	    <!-- ================ -->
	    <div class="main col-md-6 col-md-offset-3 pv-40">
		    <h1 class="page-title"><span class="text-default">Thank you for joining</span></h1>
		    <h2>You won't be charged until everyone chips in</h2>

        <p>
          Congratulations, your payment has been approved but we wont charge you unless the deal you entered for is completed.
        </p>

		    <a href="{{ url("float", $payment->float_id) }}" class="btn btn-default btn-animated btn-lg">Go to deal page <i class="fa fa-check"></i></a>
	    </div>
	    <!-- main end -->

    </div>
  </div>
@endsection

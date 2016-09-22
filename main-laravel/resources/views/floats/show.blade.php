@extends('app')

@section('title')
  {{ $deal->name }}
@endsection

@section('js')
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script src="{{ asset('js/lib/jquery.knob.min.js') }}"></script>
  <script src="{{ asset('js/lib/bootstrap-tagsinput.js' )}}"></script>
  <script src="{{ asset('js/invite_dialog.js') }}"></script>

  @if ($redirect_to_payment && ($deal->completed == 0))
    <script>
     $(document).ready(function() {
         $("#joinButton").click();
     });
    </script>
  @endif
@endsection

@section('content')
  <div class="container" id="float-details">


    @if (session('error'))
      <div class="alert alert-icon alert-danger" role="alert">
		    <i class="fa fa-times"></i>
		    {{ session('error') }}
	    </div>
    @endif

    @if (session('success'))
      <div class="alert alert-icon alert-success" role="alert">
		    <i class="fa fa-check"></i>
		    {{ session('success') }}
	    </div>
    @endif


    @if ($deal->status == 0)
      @include('floats/actions')
    @endif

    <h1>{{ $deal->name }}</h1>
    <div class="separator-2"></div>

    <div class="row">
      <div class="col-md-4 pv-20 float-image">
        <img  src="{{ asset($deal->image_path) }}" />
      </div>

      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6">
            <h2>Description</h2>
            <p>{{ $deal->description }}</p>

          </div>
          <div class="col-md-6">
            <h2>PROGRESS</h2>

            @if ($deal->completed == 1)
              <button disabled="disabled" class="btn margin-clear">
                This deal has been completed
              </button>
            @endif

            <p>
              <div class="hidden">Invitations sent: <strong>{{ count($invites) }}</strong><br /></div>
              Joined: <strong>{{ count($paid_payments) }}</strong><br />
              Total required to start: <strong>{{ $deal->ods }}</strong>
            </p>

            <div class="progress style-1">
					    <span class="text">
                Join Progress ({{ round((count($paid_payments) * 100)/$deal->ods, 2) }}%)
              </span>
					    <div class="progress-bar progress-bar-success" role="progressbar" data-animate-width="{{ round((count($paid_payments) * 100)/$deal->ods, 2) }}%">
						    <span class="label object-non-visible" data-animation-effect="fadeInLeftSmall" data-effect-delay="1000">Success - 50%</span>
					    </div>
				    </div>


            @if ($deal->completed == false)
              <p class="text-muted">
              Still {{ $deal->ods - count($paid_payments) }} more to go before starting.
              </p>
              @endif
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">

            <div class="p-10 clearfix">
				      <span class="product price">
                <i class="icon-tag pr-10"></i>
                {{ money_format('$%i', $deal->price) }}
              </span>

              <hr />


              {{-- do not display if. uploaded and organizer --}}
              @if (!$deal->from_product && Auth::user()->id == $deal->user_id)
                <p>You are the organizer of this uploaded product. Invite your friends to participate.</p>
              @else
				      <div class="product elements-list clearfix">
                @if (($deal->status == 0) && ($deal->completed == false))
                  {!! Form::open(array(
                      'route' => 'payment',
                      'class' => 'form',
                      'novalidate' => 'novalidate')) !!}
                  {!! Form::hidden("float_id", $deal->id) !!}
                  {!! Form::hidden("is_final", 0) !!}
                  {!! Form::hidden("description", "A chance of winning: " . $deal->name) !!}
                  {!! Form::hidden("price", round($deal->price/$deal->ods, 2)) !!}
                  {!! Form::hidden("quantity", 1) !!}
                  {!! Form::hidden("transaction_description", "A change of winning on floatthat.com") !!}
                  {!! Form::hidden("original_url", url("float", $deal)) !!}
					        <button id="joinButton" type="submit"
                          class="margin-clear btn btn-animated btn-info"
                          @if ($buttons_disabled)
                          disabled="disabled"
                          @endif
                          >
                    Join
                    ({{ money_format('$%i', round($deal->price/$deal->ods, 2)) }})
                    <i class="fa fa-cc-paypal"></i>
                  </button>
                  {!! Form::close() !!}


                  {!! Form::open(array(
                      'route' => 'payment',
                      'class' => 'form',
                      'novalidate' => 'novalidate')) !!}
                  {!! Form::hidden("float_id", $deal->id) !!}
                  {!! Form::hidden("is_final", 1) !!}
                  {!! Form::hidden("description", $deal->name) !!}
                  {!! Form::hidden("price", $deal->price) !!}
                  {!! Form::hidden("quantity", 1) !!}
                  {!! Form::hidden("transaction_description", $deal->name) !!}
                  {!! Form::hidden("original_url", url("float", $deal)) !!}
					        <button type="submit"
                          class="margin-clear btn btn-animated btn-primary"
                          @if ($buttons_disabled)
                          disabled="disabled"
                          @endif
                          >
                    Buy Now ({{ money_format('$%i', $deal->price) }})
                    <i class="fa fa-cc-paypal"></i>
                  </button>
                  {!! Form::close() !!}
                @endif
				      </div>
              @endif
			      </div>

            <p class="text-right"><small>
              This float was created by
              @if ($organizer->avatar)
                <img class="organizer-avatar" src="{{ $organizer->avatar }}" alt="{{ $organizer->name }}"/>
              @else
                <img class="organizer-avatar" src="/img/profile-no-photo.png" alt="{{ $organizer->name }}"/>
              @endif
              {{ $organizer->name }}

            </small></p>


            @if ($deal->type == 1)
              <div class="alert alert-warning" role="alert">
		            This is a <strong>private deal</strong>, only registered users with an invitation can join.
					    </div>
            @endif


          </div>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <hr class="mb-100 ">
      </div>
    </div>

    <section class="pv-30 light-gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
            <h3>GENERAL DETAILS</h3>
            <hr>
            <dl class="dl-horizontal">
              <dt>Created by</dt>
              <dd>
                {{ $organizer->name }}
                @if ($organizer->avatar)
                  <img class="organizer-avatar" src="{{ $organizer->avatar }}" alt="{{ $organizer->name }}"/>
                @else
                  <img class="organizer-avatar" src="/img/profile-no-photo.png" alt="{{ $organizer->name }}"/>
                @endif
                @ <time datetime="{{ $deal->start_date }}" data-format="ll">
                  {{ $deal->end_date }}</time>
              </dd>
              <dt>Type</dt>
              <dd>
                @if ($deal->type == 1)
                  Invitation only
                @else
                  Open for everyone
                @endif
              </dd>
							<dt>Total Cost</dt>
							<dd>{{ money_format('$%i', $deal->price) }}</dd>
              <dt>Total ods</dt>
							<dd>{{ $deal->ods }}</dd>
							<dt>Enter price</dt>
							<dd>{{ money_format('$%i', round($deal->price/$deal->ods, 2)) }}</dd>
              <dt>Expires</dt>
              <dd>
                <time datetime="{{ $deal->end_date }}" data-format="ll">
                  {{ $deal->end_date }}</time>
              </dd>
       			</dl>

            @include('floats/invites_details')

					</div>

					<!-- sidebar start -->
					<!-- ================ -->
					<aside class="col-md-4 col-lg-3 col-lg-offset-1" id="others">
						<div class="sidebar">
							<div class="block clearfix">
								<h3 class="title">Other Products</h3>
								<div class="separator-2"></div>

                @foreach ($others as $product)
                  <div class="media margin-clear">
									  <div class="media-left">
										  <div class="overlay-container thumb">
											  <img class="media-object" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
											  <a href="{{ url('float', $product) }}" class="overlay-link small"><i class="fa fa-link"></i></a>
										  </div>
									  </div>
									  <div class="media-body">
										  <h6 class="media-heading"><a href="{{ url('float', $product) }}">{{ $product->name }}</a></h6>
										  <p class="price">
                        {{ money_format('$%i', $product->price) }}
                      </p>
									  </div>

                    <br />

								  </div>
                @endforeach

							</div>
						</div>
					</aside>
					<!-- sidebar end -->

				</div>
			</div>
		</section>



  </div>
@endsection

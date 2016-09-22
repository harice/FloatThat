@extends('app')

@section('title')
  Home
@endsection

@section('content')
  <div class="container">
	  <div class="row">

      <div class="col-md-4">
        <h1>{{ $user->name }}</h1>

        <div class="row">
          <div class="col-md-3 col-sm-3">
            @if (Auth::user()->avatar)
              <img class="avatar" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"/>
            @else
              <img class="avatar" src="/img/profile-no-photo.png"
                   alt="{{ Auth::user()->name }}" />
            @endif
          </div>
          <div class="col-md-9 col-sm-9">
            User joined<br />
            <strong>
            <time datetime="{{ $user->created_at }}" data-format="lll">
              {{ $user->created_at }}</time>
            </strong>
            <br /><br />

            User Email<br />
            <strong>
              {{ $user->email }}
            </strong>
            <br /><br />


            Created deals: <br />
            <strong>{{ count($user_deals) }}</strong>

          </div>
        </div>
      </div>

		  <div class="col-md-8">

				<!-- Nav tabs -->
				<ul class="nav nav-tabs style-1" role="tablist">
					<li class="active">
            <a href="#htab1" role="tab" data-toggle="tab">
              <i class="fa fa-home pr-10"></i> My Float Deals
            </a>
          </li>

					<li>
            <a href="#htab2" role="tab" data-toggle="tab">
              <i class="fa fa-user pr-10"></i> My Buy Deals
            </a>
          </li>

					<li>
            <a href="#htab3" role="tab" data-toggle="tab">
              <i class="fa fa-envelope pr-10"></i> Invites Sent
            </a>
          </li>

          <li>
            <a href="#htab4" role="tab" data-toggle="tab">
              <i class="fa fa-envelope pr-10"></i> Invites Received
            </a>
          </li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane fade in active" id="htab1">
            <h4>My organized deals</h4>
						<div class="row">
							<div class="col-md-12">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Ods</th>
                        <th>Price<small>/Float</small></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($user_deals as $deal)
                        <tr>
                          <td>
                            <time datetime="{{ $deal->start_date }}" data-format="ll">
                            {{ $deal->end_date }}</time>

                          </td>
                          <td><a href="{{ url("float", $deal->id) }}">{{ $deal->name }}</a></td>
                          <td>{{ $deal->type ? "Invitation" : "Open" }}</td>
                          <td>{{ $deal->ods }}</td>
                          <td>
                            {{ money_format('$%i',$deal->price) }}
                            <small>/{{ money_format('$%i', round($deal->price/$deal->ods, 2)) }}</small>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
						</div>
					</div>

					<div class="tab-pane fade" id="htab2">
						<h4>Deals you are participating in</h4>
						<div class="row">
							<div class="col-md-12">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Paid</th>
                        <th>Ods</th>
                        <th>Price<small>/Float</small></th>
                        <th>In Progress</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($bought_deals as $deal)
                        <tr>
                           <td>
                            <time datetime="{{ $deal->created_at }}" data-format="ll">
                            {{ $deal->created_at }}</time>
                          </td>
                          <td><a href="{{ url("float", $deal->float_id) }}">{{ $deal->name }}</a></td>
                          <td>{{ money_format('$%i',$deal->amount) }}</td>
                          <td>1 in {{ $deal->ods }}</td>
                          <td>
                            {{ money_format('$%i',$deal->price) }}
                            <small>/{{ money_format('$%i', round($deal->price/$deal->ods, 2)) }}</small>
                          </td>
                          <td>{{ $deal->status ? "Completed" : "In Progress" }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
					  </div>
          </div>

					<div class="tab-pane fade" id="htab3">
						<div class="row">
							<div class="col-md-12">
                <h4>Sent</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Float</th>
                        <th>Date</th>
                        <th>To</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($user_sent_invites as $invite)
                        <tr>
                          <td>
                            <a href="{{ url("float", $invite->float_id) }}">
                              {{ $invite->name }}
                            </a>
                          </td>
                          <td>
                            <time datetime="{{ $invite->created_at }}" data-format="ll">
                              {{ $invite->created_at }}</time>
                          </td>
                          <td>{{ $invite->email_address }}</td>
                          <td>{{ $invite->accepted ? "Accepted" : "Pending" }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
							</div>
						</div>
					</div>


          <div class="tab-pane fade" id="htab4">
						<div class="row">
              <div class="col-md-12">
                <h4>Received</h4>

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Float</th>
                        <th>Date</th>
                        <th>Deal</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($user_invites as $invite)
                        <tr>
                          <td>
                            <a href="{{ url("float", $invite->float_id) }}">
                              {{ $invite->name }}
                            </a>
                          </td>

                          <td>
                            <time datetime="{{ $invite->created_at }}" data-format="ll">
                              {{ $invite->created_at }}</time>

                          </td>
                          <td>{{ $invite->email_address }}</td>
                          <td>{{ $invite->accepted ? "Accepted" : "Pending" }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
	            </div>
            </div>
          </div>

				</div>
				<!-- tabs end -->

	    </div>

      <div class="row" style="display: none;">
        <div class="col-md-12">
          <h3>Connect your social accounts</h3>
          <hr />

          <div class="row">
            <div class="col-md-3 text-center">
              <i class="{{ ($user->facebook_provider_id) ? "text-primary" : "" }} fa fa-5x fa-facebook-square"></i><br />
              Facebook connected:<br />
              @if ($user->facebook_provider_id)
                <strong><span class="text-success">
                  <i class="fa fa-check"></i> Yes.
                </span></strong>
              @else
                <strong>No.</strong> <a href="{{ url("facebook") }}">Connect</a>
              @endif
            </div>
            <div class="col-md-3 text-center">
              <i class="{{ ($user->twitter_provider_id) ? "text-primary" : "" }} fa fa-5x fa-twitter-square"></i><br />
              Twitter connected:<br />
              @if ($user->twitter_provider_id)
                <strong><span class="text-success">
                  <i class="fa fa-check"></i> Yes.
                </span></strong>
              @else
                <strong>No.</strong> <a href="{{ url("twitter") }}">Connect</a>
              @endif
            </div>
          </div>
        </div>
      </div>

		</div>
  </div>
@endsection

@if (Auth::check())
  @if (Auth::user()->id == $deal->user_id)
    <br />
    <h3>INVITATIONS DETAILS</h3>
    <hr>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs style-4" role="tablist">
      <li class="active"><a href="#h2tab1" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-files-o pr-5"></i>Accepted</a></li>
      <li><a href="#h2tab2" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-files-o pr-5"></i>Pending</a></li>
			<li class=""><a href="#h2tab3" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-star pr-5"></i>Declined</a></li>

		</ul>
		<!-- Tab panes -->
		<div class="tab-content padding-top-clear padding-bottom-clear">

      <div class="tab-pane fade active in" id="h2tab1">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Email Address</th>
              </tr>
            </thead>
            <tbody>
              @for ($i = 0; $i < count($accepted); $i++)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $accepted[$i]->email_address }}</td>
                </tr>
              @endfor
              @if (count($accepted) == 0)
                <tr>
                  <td colspan="2">No one has accepted yet.</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
			</div>

      <div class="tab-pane fade in" id="h2tab2">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Email Address</th>
              </tr>
            </thead>
            <tbody>
              @for ($i = 0; $i < count($pending); $i++)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $pending[$i]->email_address }}
                </tr>
              @endfor
              @if (count($pending) == 0)
                <tr>
                  <td colspan="2">There are no pending invites.</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>

			</div>

			<div class="tab-pane fade" id="h2tab3">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Email Address</th>
              </tr>
            </thead>
            <tbody>
              @for ($i = 0; $i < count($declined); $i++)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $declined[$i]->email_address }}
                </tr>
              @endfor
              @if (count($declined) == 0)
                <tr>
                  <td colspan="2">No one has declined yet.</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
			</div>
		</div>
  @endif
@endif

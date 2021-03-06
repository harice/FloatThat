@section('css')
  <link href="{{ asset('css/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endsection

@if (Auth::check() && !$deal->completed)
  @if (Auth::user()->id == $deal->user_id)
    <div class="row">

      <div class="col-md-12">
        <div class="well text-center">
          <h3>You are the organizer of this float</h3>
          <h5>Invite your friends to participate</h5>

          <a class="btn btn-primary btn-lg btn-animated" href="http://www.facebook.com/dialog/send?app_id=1654810721416394&link={{ url("float/share", $deal) }}&redirect_uri={{ url("float", $deal) }}/">
            Invite Facebook Friends <i class="fa fa-facebook-square"></i></a>
          <a href="#" class="btn btn-info btn-lg btn-animated twitter" data-toggle="modal" data-target="#inviteDialog" data-title="Invite Twitter Friends" data-url="{{ url("invite/twitter_friends", $deal->id) }}">
            Invite Twitter Friends <i class="fa fa-twitter-square"></i>
          </a>
          <a href="#" class="btn btn-default btn-lg btn-animated email" data-toggle="modal" data-target="#inviteDialog" data-title="Invite Friends By Email" data-url="{{ url("invite/email_friends", $deal->id) }}">
            Invite Friends By Email <i class="fa fa-envelope"></i>
          </a>

          <a href="https://www.facebook.com/dialog/feed?app_id=1654810721416394&caption={{ $deal->name . " - " . $deal->description }}&link={{ url("float/share", $deal) }}&redirect_uri={{ url("float", $deal) }}" class="btn btn-warning btn-lg btn-animated email"">
            Post to Facebook <i class="fa fa-facebook-square"></i>
          </a>

          <br />

          <a href="#" class="facebook" data-toggle="modal" data-target="#inviteDialog" data-title="Invite Facebook Friends" data-url="{{ url("invite/facebook_friends", $deal->id) }}">
            Invite Facebook Friends
          </a>

        </div>
      </div>

      <div class="col-md-3">
        <div class="">

        </div>
      </div>

    </div>

    <div class="modal fade" id="inviteDialog" tabindex="-1" role="dialog" aria-labelledby="invitebDialogLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="inviteDialogLabel">Invite</h4>
          </div>
          <div class="modal-body">

          </div>
        </div>
      </div>
    </div>
  @endif
@endif

@if ($isConnected)

  {!! Form::open(
      array(
          'route' => 'sendemailinvites',
          'class' => 'form',
          'novalidate' => 'novalidate')) !!}
  <strong>
    You have a 1 in {{ $deal->ods }} chances of winning this deal for {{ money_format('$%i', round($deal->price/$deal->ods, 2)) }}.
  </strong>
  <br />
  Please invite your friends, first {{ $deal->ods }} to accept will Float the Deal.
  <br /><br />

  <div id="friend_list" class="row">
    <p class="text-center">
      Click on a friends name or picture to select as a recipient for this invite.
    </p>

    @foreach ($friends as $friend)
      <div class="col-md-4 friend">
        <a href="#">
          <img src="{{ $friend->picture->data->url }}" class="pull-left" />
          <span class="name">{{ $friend->name }}</span>
        </a>
      </div>
    @endforeach

    <div class="col-md-12" id="load_more">
      <a href="#" data-load="{{ $next }}" class="btn btn-block btn-info">Load more friends</a>
    </div>

  </div>

  <div class="form-group text-center">
    {!! Form::submit('Send Invites', array('class' => 'btn btn-default submit')) !!}
  </div>

  {!! Form::close() !!}

@else
  <h4>Facebook Connect</h4>
  <p>You need to connect Facebook before inviting your Facebook friends.</p>
  <p class="text-center"><a href="{{ url("facebook") }}" class="btn btn-primary"> Continue</a>
@endif

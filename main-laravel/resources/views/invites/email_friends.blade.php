{!! Form::open(
    array(
        'route' => 'sendemailinvites',
        'class' => 'form',
        'novalidate' => 'novalidate')) !!}

<div class="row">
  <div class="col-md-12">

    <strong>
      You have a 1 in {{ $deal->ods }} chances of winning this deal for {{ money_format('$%i', round($deal->price/$deal->ods, 2)) }}.
    </strong>
    <br />
    Please invite your friends, first {{ $deal->ods }} to accept will Float the Deal.
    <br /><br />


    {!! Form::hidden("float_id", $deal->id) !!}
    <div class="form-group">
      {!! Form::text('to', null,
          array(
              'class' => 'form-control',
              'data-role' => "tagsinput",
              'id' => "recipients",
              'placeholder' => "Type Email"
          ))
      !!}
      <p class="help-block">Type email address and hit enter or comma to add another</p>
    </div>

    <div class="form-group">
      {!! Form::submit('Send Invites', array('class' => 'btn btn-default')) !!}
    </div>

  </div>
</div>

{!! Form::close() !!}

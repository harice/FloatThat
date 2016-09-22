<div style="margin: 0 auto; width: 600px;">

  <h1 style="text-align: center">
    Congratulations, you are the winner!
  </h1>

  <div style="text-align: center">
    <img width="400" class="media-object" src="{{ asset($deal->image_path) }}" alt="{{ $deal->name }}">
  </div>

  <hr />

  <br /><br />

  <h3>
    {{ $deal->name }}, valued {{ money_format('$%i', $deal->price) }}
  </h3>

  <p>
    <strong>
      Today, is without any doubt your lucky day, you are the winner for this deal.
    </strong>
  </p>

  <p>
    On {{ $winner->updated_at }} you decided to get a chance of winnign for just {{ money_format('$%i', round($deal->price/$deal->ods, 2)) }}, and that was good decision.
  </p>

  <br /><br /><br />

  <p>
    <small>
      view more details at: {{ $float_url }} <br />
    </small>
  </p>

</div>

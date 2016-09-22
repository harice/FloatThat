<div style="margin: 0 auto; width: 600px;">

  <h1 style="text-align: center">
    We have a winner
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
      Congratulations to {{ $winner->name }} for winning this deal.
      This deal is now over. We have charged you {{ money_format('$%i', round($deal->price/$deal->ods, 2)) }} to your paypal accont.
    </strong>
  </p>

  <br /><br /><br />

  <p>
    <small>
      view more details at: {{ $float_url }} <br />
    </small>
  </p>

</div>

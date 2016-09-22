<div style="margin: 0 auto; width: 600px;">

  <h1 style="text-align: center">
    {{ $deal->name }}, valued {{ money_format('$%i', $deal->price) }}
  </h1>

  <div style="text-align: center">
    <img width="400" class="media-object" src="{{ asset($deal->image_path) }}" alt="{{ $deal->name }}">
    <br />
    <p>
      {{ $deal->description }}
    </p>
  </div>

  <hr />

  <br /><br />

  <h3>
    Your friend <strong>{{ $host->name }}</strong> has sent you a chance of winning.
  </h3>

  <p>
    <strong>
      You have a 1 in {{ $deal->ods }} chances of winning this deal for {{ money_format('$%i', round($deal->price/$deal->ods, 2)) }}.
    </strong>
  </p>

  <p>
    Follow the link to accept or decline the invite:<br />
    {{ $base_url }}/?code={{ $invite->code }}&email={{ $invite->email_address }}
  </p>

  <br /><br /><br />

  <p>
    <small>
      view more details at: {{ $float_url }} <br />
    </small>
  </p>

</div>

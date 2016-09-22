<div style="margin: 0 auto; width: 600px;">

  <h1 style="text-align: center">
    Congratulations, you just bought
  </h1>

  <div style="text-align: center">
    <img width="400" class="media-object" src="{{ asset($deal->image_path) }}" alt="{{ $deal->name }}">
  </div>

  <hr />

  <br /><br />

  <h3>
    {{ $deal->name }}, valued {{ money_format('$%i', $deal->price) }}
  </h3>

  <br /><br />

  <p>
    <small>
      view more details at: {{ $float_url }} <br />
    </small>
  </p>

</div>

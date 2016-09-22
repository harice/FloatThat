@extends('app')

@section('title')
  {{ $deal->name }}
@endsection

@section('tags')
  <meta property="og:locale" content="en_US" />
  <meta property="og:title" content="{{ $deal->name }}, valued {{ money_format('$%i', $deal->price) }}" />
  <meta property="og:site_name" content="Floatthat.com"/>
  <meta property="og:url" content="{{ url("float/share", $deal) }}" />
  <meta property="og:description" content="{{ $deal->description }}" />
  <meta property="fb:app_id" content="1654810721416394" />
  <meta property="og:image" content="{{ asset($deal->image_path) }}" />
@endsection

@section('content')
  <div class="container text-center" id="invite-accept">

    <h1 class="text-center">
      {{ $deal->name }}, valued {{ money_format('$%i', $deal->price) }}
    </h1>

    <img width="500" src="{{ asset($deal->image_path) }}" alt="{{ $deal->name }}">
    <br />
    <p>
      {{ $deal->description }}
    </p>
    <hr />

    <p>
      <strong>
        You have a 1 in {{ $deal->ods }} chances of winning this deal for {{ money_format('$%i', round($deal->price/$deal->ods, 2)) }}.
      </strong>
    </p>


    <div class="actions">
      <a href="{{ url('float', $deal) }}" class="btn btn-animated btn-lg btn-default">Go to Deal <i class="fa fa-check"></i></a>
    </div>

  </div>
@endsection

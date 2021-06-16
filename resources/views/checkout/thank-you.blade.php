@extends('layouts.main')
@section('title', 'Thank you!')
@section('custom-css')
<style>
    html, body {
  overflow: hidden;
}
</style>
@endsection
@section('content')
<main style="padding: 15vh 0">
<div class="jumbotron text-center" style="height: 100vh; padding-top:20vh;">
    <h1 class="display-3">Thank You!</h1>
    <p class="lead">Your order will be delivered to you soon!</p>
    <hr>
    <p>
      Having trouble? <a href="">Contact us</a>
    </p>
    <p class="lead">
      <a class="btn btn-primary btn-sm" href="{{ route('home') }}" role="button">Continue to homepage</a>
    </p>
  </div>
</main>
@endsection
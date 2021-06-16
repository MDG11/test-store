@extends('layouts.main')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="styles/credit-card.css">
@endsection
@section('custom-js')
@endsection
@section('content')
<main style="margin: 15vh 0">
    <div class="credit-form" style="margin: 20vh 30vw;">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="{{ route('proceed.payment', ['order_id' => $order->id]) }}">
                    @if (Session::has('stripe_error'))
                        <div class="alert alert-danger" role="alert">{{ Session::get('stripe_error') }}</div>
                    @endif
                    @csrf
                <div class="card">
                    <div class="card-header">
                        <strong>Credit Card</strong>
                        <small>enter your card details</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter cardholder name" pattern="(?<! )[-a-zA-Z' ]{2,40}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="ccnumber">Credit Card Number</label>
                                    <div class="input-group">
                                        <input class="form-control" name="number" type="text" pattern="^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$" placeholder="0000 0000 0000 0000" autocomplete="email">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-credit-card"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="ccmonth">Month</label>
                                <select required name="month" class="form-control" id="ccmonth">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label required for="ccyear">Year</label>
                                <select name="year" class="form-control" id="ccyear">
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <div required class="form-group">
                                    <label for="cvv">CVV/CVC</label>
                                    <input name="cvv" class="form-control" id="cvv" type="password" pattern="\d{3}" required placeholder="123">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-success float-right" type="submit">
                            <i class="mdi mdi-gamepad-circle"></i> Continue</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</main>
@endsection
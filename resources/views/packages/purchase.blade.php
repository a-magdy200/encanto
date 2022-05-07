@extends('layouts.app')
@section('page-title')
    Purchase a Package
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('packages.order')}}" role="form" class="validation" data-cc-on-file="false"
          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label for="client_id_select" class="form-label">User</label>
                <select id="client_id_select" name="client_id" class="form-control">
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="package_select" class="form-label">Training Package</label>
                <select id="package_select" name="package_id" class="form-control">
                    @foreach ($packages as $package)
                        <option value="{{$package->id}}">{{$package->package_name}}</option>
                    @endforeach
                </select>
            </div>

            @if (!auth()->user()->hasRole('Gym Manager'))
                <div class="form-group">
                    <div class="mb-3">
                        <label for="gym_select" class="form-label">Gym Name</label>
                        <select id="gym_select" name="gym_id" class="form-control">
                            @foreach ($gyms as $gym)
                                <option value="{{$gym->id}}">{{$gym->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="panel-heading">
                        <div class="row text-center">
                            <h3 class="panel-heading">Payment Details</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class='form-row row'>
                            <div class='col-6 form-group required'>
                                <label for="name" class='control-label'>Name on Card</label>
                                <input value="{{old('name')}}" id="name" name="name" class='form-control' size='4'
                                       type='text'>
                            </div>
                            <div class='col-6 form-group required'>
                                <label for="card_number" class='control-label'>Card Number</label>
                                <input value="{{old('card_number')}}" id="card_number" name="card_number"
                                       autocomplete='off'
                                       class='form-control card-num' size='20' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label for="cvc" class='control-label'>CVC</label>
                                <input value="{{old('cvc')}}" id="cvc" name="cvc" autocomplete='off'
                                       class='form-control card-cvc'
                                       placeholder='e.g 415' size='4' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label for="expiration_month" class='control-label'>Expiration Month</label>
                                <input value="{{old('expiration_month')}}" id="expiration_month" name="expiration_month"
                                       class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label for="expiration_year" class='control-label'>Expiration Year</label>
                                <input value="{{old('expiration_year')}}" id="expiration_year" name="expiration_year"
                                       class='form-control card-expiry-year'
                                       placeholder='YYYY' size='4' type='text'>
                            </div>
                        </div>
                        @if($errors->any())
                            <div class='form-row row'>
                                <div class='col-md-12 hide error form-group'>
                                    <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Purchase</button>
                </div>
    </form>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function () {
            var $form = $(".validation");
            $('form.validation, #payment-form').on('submit', function (e) {
                e.preventDefault();
                var $form = $(".validation"),
                    inputVal = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid = true;
                $errorStatus.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorStatus.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-num').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeHandleResponse);
                }

            });

            function stripeHandleResponse(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
@endsection

@extends('master')

@section ("title", " - Our offers")

@section ("styles")
@endsection

@section ("gold-plan")
	<form action="/payment" method="POST">
		{{ csrf_field() }}
		<script
			src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			data-key="{{ env('STRIPE_KEY')}}"
			data-image="{{ asset('storage/images').'/test.png' }}"
			data-name="Globil payment"
			data-description="Subscription for Gold plan"
			data-amount="99900"
			data-label="Subscribe for Gold membership!">
		</script>
	</form>
@endsection


@section('content')

	@if( @$id == 1)	
		<div class="alert alert-success">
			<h3>Welcome to Globil ! 
				<br> You have successfully registered! </h3>
			<h4>You have subscribed to standard membership for FREE !!
				<br> It ends after 4 weeks
				<br> You can post only one car within this period
				<br> After the period ends, your car will still be visible in search results, 
				<br>but your contact information will be hidden until you extend your membership to Gold.</h4>
			<h3>Expires at {{ \App\User::expiringDate()  }}.... {{ \App\User::daysRemaining()  }} days  remaining.</h3>
		</div>	
	@endif

	<div class="col-md-6 col-md-offset-3 ">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Gold membership</h2>
			</div>
			<div class="panel-body">
				<p>1 year - unlimited cars can be posted</p>
				<p>Visible contact information : <label>yes</label></p>
				<p>Price : <label>999 NOK</label></p>

				@yield('gold-plan')
			</div>
		</div>
	</div>
	
@endsection

@extends('master')

@section ("title", " - Our offers")

@section ("styles")
.alert-success strong{color: #3c763d}
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
			<br>
			<h3>Expires at {{ \App\User::expiringDate()  }}.... </h3>
			<h3>{{ \App\User::daysRemaining()  }} days  remaining.</h3>
		</div>
	@endif



	@if(auth()->check())
	
		@if(@auth()->user()->plan() == 'gold')

			<div class="col-md-8 col-md-offset-2 ">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h2>You are subscribed to Gold membership</h2>
					</div>
					<div class="panel-body">
						<p>1 year - unlimited cars can be posted</p>
						<p>Visible contact information : <label>yes</label></p>
						<p>Price : <label>999 NOK</label></p>

						<h3>Expires at <strong>{{ \App\User::expiringDate()  }}</strong>....</h3>
						<h3><strong> {{ \App\User::daysRemaining()  }}</strong> days  remaining.</h3>

					</div>
				</div>
			</div>

		@elseif( @auth()->user()->plan() == 'standard')

			<h3>You are a standard member.</h3>
			<h3>Expires at <strong>{{ \App\User::expiringDate()  }}</strong>.... </h3>
			<h3><strong>{{ \App\User::daysRemaining()  }}</strong> days  remaining.</h3>

			<div class="col-md-8 col-md-offset-2 ">
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

		@endif

		<!-- GUEST -->
	@else

		<div class="col-md-6 ">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h2>Gold membership</h2>
				</div>
				<div class="panel-body">
					<p>1 year - <label>unlimited cars</label> can be posted</p>
					<p>Visible contact information : <label>yes</label></p>
					<p>Price : <label>999 NOK</label></p>

					<a href="/register" class="btn btn-primary">Register</a>
				</div>
			</div>
		</div>

		<div class="col-md-6 ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>Standard membership</h2>
				</div>
				<div class="panel-body">
					<p>4 weeks - <label>1 car</label> can be posted</p>
					<p>Visible contact information : <label>yes</label></p>
					<p>Price : <label>0 NOK</label></p>

					<a href="/register" class="btn btn-primary">Register for free</a>
				</div>
			</div>
		</div>
	
	@endif
	
	
@endsection

<form action="/payment" method="POST">
	{{ csrf_field() }}
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="{{ env('STRIPE_KEY')}}"
		data-image="{{ asset('storage/images').'/test.png' }}"
		data-name="Globil payment"
		data-description="Subscription for {{ $myPlan['name'] }} plan"
		data-amount="{{ $myPlan['price'] }}00"
		data-label="Subscribe for {{ $myPlan['name'] }} membership!">
	</script>
	<!-- <input type="text" name="data1" > -->
</form>
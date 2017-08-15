@extends('master')

@section ("title", " - My profile")

@section ("content")

	<div class="my-profile">
		
		<div class="notifications col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 v-cloak>Notifications ( @{{unreadNotifications.length}} )</h3>
				</div>

				<div class="panel-body" v-cloak>
					<a v-if="unreadNotifications.length > 0"
						v-for="notif in unreadNotifications" :href="'/cars/' + notif.data.car">

						<h3><span class="label label-info">@{{ notif.data.message }}</span></h3>
					</a >

					<a v-for="notif in readNotifications" :href="'/cars/' + notif.data.car">
						<h3><span class="label label-default">@{{ notif.data.message }}</span></h3>
					</a>

					<label v-if="readNotifications.length + unreadNotifications.length == 0">
						No notifications.</label>
				</div>
			</div>
		</div>
		
		<div class="subscriptions col-md-4">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3>My subscription</h3>
				</div>

				<div class="panel-body">
					<h3>
						<p>Subscription plan: <br><label>{{ auth()->user()->plan() }}</label></p>
						<p>Expiration date: <br><label>{{ auth()->user()->expiringDate() }}</label></p>
						<p>Days remaining: <br><label>{{ auth()->user()->daysRemaining() }} days</label></p>
					</h3>
				</div>	
			</div>
			
		</div>

	</div>

@endsection

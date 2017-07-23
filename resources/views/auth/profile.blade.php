@extends('master')


@section ("content")

	<h1>Notifications ( @{{readNotifications.length + unreadNotifications.length}})</h1>


	<a v-if="unreadNotifications.length > 0"
		v-for="notif in unreadNotifications" :href="'/cars/' + notif.data.car.id">

		<h3><span class="label label-info">@{{ notif.data.message }}</span></h3>
	</a >


	<a v-for="notif in readNotifications" :href="'/cars/' + notif.data.car.id">
		<h3><span class="label label-default">@{{ notif.data.message }}</span></h3>
	</a>
	


@endsection

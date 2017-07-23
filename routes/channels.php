<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| The given channel authorization callbacks are used to check if
|  an authenticated user can listen to the channel. */

Broadcast::channel('App.User.{id}', function ($user, $id) {
	return (int) $user->id === (int) $id;
});

// The user is in SavedSearch results

Broadcast::channel('ch-{user_id}', function ($user, $user_id) { 
	return $user;
});


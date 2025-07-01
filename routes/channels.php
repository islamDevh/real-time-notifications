<?php

use App\Broadcasting\NewUserChannel;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Broadcast::channel('new_user_channel', function ($admin) {
//     // return true; // or add your own logic, it should return true value
//     return $admin->type == 'super_admin'; // or add your own logic, it should return true value
// }, ['guards' => ['admin']]);


// or separate class for channel
// Broadcast::channel('new_user_channel', NewUserChannel::class,['guards' => ['admin']]);


// presence channel
// Broadcast::channel('admin_room_channel', function ($admin) {
//     return [
//         'id' => $admin->id,
//         'name' => $admin->name,
//         'type' => $admin->type,
//     ];
// }, ['guards' => ['admin']]);

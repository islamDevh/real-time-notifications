<?php

namespace App\Broadcasting;

use App\Models\Admin;
use App\Models\User;

class NewUserChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(Admin $admin): array|bool
    {
        return $admin->type == 'super_admin'; // or add your own logic, it should return true value
    }
}

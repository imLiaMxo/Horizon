<?php

namespace App\Events;

use App\Models\Role;

class RoleUpdated
{
    public Role $role;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
}

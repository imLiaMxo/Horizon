<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use Notifiable, HasFactory, HasRoles;

    protected $fillable = [
        'name', 'steamid', 'avatar'
    ];

    protected $hidden = [
        'remember_token'
    ];

    public function displayRole(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'display_role_id');
    }
}

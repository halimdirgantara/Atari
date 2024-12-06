<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;


    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'nip',
        'nik',
        'organization_id',
        'phone',
    ];


    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'structures', 'user_id', 'organization_id');
    }



    public function guestBooks(): HasMany
    {
        return $this->hasMany(GuestBook::class,'guest_book_guest', 'guest_id', 'host_id');
    }


}

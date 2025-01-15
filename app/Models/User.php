<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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


    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }



    public function guestBooks(): HasMany
    {
        return $this->hasMany(GuestBook::class,'guest_book_guest', 'guest_id', 'host_id');
    }


}

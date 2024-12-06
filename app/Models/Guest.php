<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'organization',
        'identity_id',
        'identity_file',
        'guest_token',
    ];
    public function guestBooks()
    {
        return $this->hasMany(GuestBook::class, 'guest_id','id');
    }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'head_id'
    ];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'structures', 'organization_id', 'user_id');
    }

    public function guestBooks()
    {
        return $this->hasMany(GuestBook::class);
    }
}


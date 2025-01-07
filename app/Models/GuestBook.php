<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuestBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'name',
        'host_id',
        'organization_id',
        'needs',
        'check_in',
        'check_out',
        'status',
    ];



    public const STATUS = [
        'process' => 'Process',
        'pending' => 'Pending',
        'approved' => 'Approved',
        'declined' => 'Declined',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function guests(): BelongsToMany
    {
        return $this->belongsToMany(Guest::class, 'guest_book_guest', 'guest_book_id', 'guest_id');
    }
    public function scopeByOrganization($query, $organizationId)
    {
        return $query->where('organization_id', $organizationId);
    }



}

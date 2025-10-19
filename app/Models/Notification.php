<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'message',
        'recipient',
        'type',
        'date',
        'is_read',
    ];

    protected $casts = [
        'date' => 'date',
        'is_read' => 'boolean',
    ];

    /**
     * Get the recipient user of this notification.
     */
    public function recipientUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient');
    }

    /**
     * Scope for unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead()
    {
        $this->update(['is_read' => 1]);
    }
}

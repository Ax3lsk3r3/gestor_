<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    // Specify custom timestamp columns
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null; // Disable updated_at

    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'due_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * Get the user assigned to this task.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Scope for pending tasks
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for in progress tasks
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Scope for completed tasks
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for overdue tasks
     */
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now()->format('Y-m-d'))
            ->where('status', '!=', 'completed')
            ->whereNotNull('due_date')
            ->where('due_date', '!=', '0000-00-00');
    }

    /**
     * Scope for tasks due today
     */
    public function scopeDueToday($query)
    {
        return $query->where('due_date', now()->format('Y-m-d'))
            ->where('status', '!=', 'completed');
    }

    /**
     * Scope for tasks with no deadline
     */
    public function scopeNoDeadline($query)
    {
        return $query->where(function($q) {
            $q->whereNull('due_date')
              ->orWhere('due_date', '0000-00-00');
        })->where('status', '!=', 'completed');
    }
}

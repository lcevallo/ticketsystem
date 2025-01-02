<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    const PRIORITY = [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High',
    ];

    const STATUS = [
        'open' => 'Open',
        'closed' => 'Closed',
        'solved' => 'Solved',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'comment',
        'assigned_by',
        'assigned_to',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'assigned_by' => 'integer',
        'assigned_to' => 'integer',
    ];

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'assigned_by');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class,'assigned_to');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}

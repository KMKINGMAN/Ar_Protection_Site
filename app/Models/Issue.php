<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Issue extends Model
{
    protected $fillable = [
        'user_id',
        'caseId',
        'name',
        'status',
        'evidences'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}

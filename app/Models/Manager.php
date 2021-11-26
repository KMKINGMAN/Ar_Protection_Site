<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manager extends Model
{
    protected $fillable = ['user_id'];
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}

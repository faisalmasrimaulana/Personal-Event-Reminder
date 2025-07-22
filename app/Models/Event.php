<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_event',
        'user_id'
    ];

    public function users():BelongsTo {
        return $this->belongsTo(User::class); 
    }
}

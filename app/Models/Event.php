<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


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

    public function getTanggalFormattedAttribute(){
        Carbon::setLocale('id');

        return Carbon::parse($this->tanggal_event)->translatedFormat('l, d F Y, H:i');
    }
}

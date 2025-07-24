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
        'user_id',
    ];

    public function user():BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }

    public function getTanggalFormattedAttribute(){
        return Carbon::parse($this->tanggal_event)->translatedFormat('l, d F Y, H:i');
    }

    public function getWaktuEventAttribute()
    {
        $now = now();
        $eventTime = Carbon::parse($this->tanggal_event)->timezone(config('app.timezone'));
        $selisihJam = $now->diffInHours($eventTime, false);

        if ($now->lessThan($eventTime) && $selisihJam < 24) {
            return 'Event dimulai dalam ' . $eventTime->diffForHumans($now, true) . ' lagi';
        }

        if ($now->greaterThan($eventTime) && abs($selisihJam) <= 12) {
            return 'Event sedang berlangsung sejak ' . $eventTime->diffForHumans($now);
        }

        if ($now->greaterThan($eventTime) && abs($selisihJam) > 12) {
            return 'Event telah berakhir';
        }

        return null;
    }

}

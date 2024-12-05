<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';

    protected $fillable = [
        'name_event',
        'id_event_detail',
    ];

    public function eventDetail()
    {
        return $this->belongsTo(EventDetail::class, 'id_event_detail');
    }

    public function interests()
    {
        return $this->hasMany(Interest::class, 'id_event');
    }

}
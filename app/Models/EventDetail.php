<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
    //
    use HasFactory;
    protected $table = 'event_detail';
    protected $fillable = [
        'description',
        'date_event',
        'image_event',
        'name_location',
    ];

    public function events()
    {
        return $this->hasOne(Event::class, 'id_event_detail');
    }
}
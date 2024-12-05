<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interest extends Model
{
    //
    use HasFactory;
    protected $table = 'interest';

    protected $fillable = [
        'full_name',
        'email',
        'id_event',
    ];

    public function event(){
        return $this->belongsTo(Event::class,'id_event');
    }
}

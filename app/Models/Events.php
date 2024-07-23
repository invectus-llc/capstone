<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'eventName',
        'eventStart',
        'eventEnd',
        'clientId',
        'status',
    ];
}

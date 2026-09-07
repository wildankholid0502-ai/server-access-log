<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use HasFactory;

    protected $fillable = [
    'ticket_number',
    'visitor_name',
    'department',
    'escort_name',
    'category',
    'temp_room',
    'hum_room',
    'temp_rack_1', 'hum_rack_1',
    'temp_rack_2', 'hum_rack_2',
    'temp_rack_3', 'hum_rack_3',
    'temp_rack_4', 'hum_rack_4',
    'temp_rack_5', 'hum_rack_5',
    'temp_rack_6', 'hum_rack_6',
    'visual_check',
    'notes',
    'logged_at',
];
}
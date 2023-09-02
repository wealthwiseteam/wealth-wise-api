<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'icon',
        'color',
        'note',
        'start_date',
        'end_date',
        'current_amount',
        'target_amount',
        'user_id',
        'category_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'is_active',
        'icon',
        'color'
    ];

    public function budgets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Budget::class);
    }

    public function plans(){
        return $this->hasMany(Plan::class);
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }

}

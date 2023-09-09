<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table='transactions';
    protected $fillable = [
        'name',
        'account_id',
        'amount',
        'type'
    ];

    public function accounts(){
        return $this->belongsTo(Account::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $table = 'withdraws';
    protected $fillable = [
        'user_id',
        'withdraw_id',
        'transaction_type',
        'amount',
        'status'
    ];

    public static $statusArrays = ['pending', 'accepted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_id(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function user_methods_id(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}

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
        'amount',
        'status'
    ];

    public static $statusArrays = ['pending', 'accepted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function withdraw(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Payment::class, 'id', 'withdraw_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $table = 'deposits';

    protected $fillable = [
        'user_id',
        'amount',
        'transaction_id',
        'payment_no',
        'transaction_type',
        'status',
    ];

    public static $statusArrays = ['accepted','pending'];
}

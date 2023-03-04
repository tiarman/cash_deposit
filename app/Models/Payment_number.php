<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_number extends Model
{
    use HasFactory;
    protected $table = 'payment_number';
    protected $fillable = [
        'number',
        'user_id',
        'method_id'
    ];

    public function methods(){
        return $this->belongsTo(Payment::class,'method_id','id');
    }

}

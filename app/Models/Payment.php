<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payments";
   protected $fillable = [
    'name',
    'name_key',
    'user_id',
    'mobile',
    'image',
    'status',
   ];
   public static $statusArray = ['active','inactive'];
   public static $paymentMethods = [
    'bkash_agent' => 'Bkash Agent',
    'bkash_personal' => 'Bkash Personal',
    'nagad_personal' => 'Nagad Personal',
    'rocket_personal' => 'Rocket Personal',
    'upay_personal' => 'Upay Personal',
   ];


}

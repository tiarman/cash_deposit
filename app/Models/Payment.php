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
    'user_id',
    'mobile',
    'image',
    'status',
   ];
   public static $statusArray = ['active','inactive'];


}

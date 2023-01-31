<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
      'name',
      'type',
      'file',
      'status'
    ];
    public static $typeArrays = ['academic', 'training' ,'experience','others'];
    public static $statusArrays = ['inactive', 'active' ,'rejected'];
}

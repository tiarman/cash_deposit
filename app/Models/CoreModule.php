<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreModule extends Model
{
    use HasFactory;
    protected $table ='core_modules';
    protected $fillable = [
      'name',
      'link',
      'image',
      'status',
    ];

    public static $statusArrays = ['active', 'inactive'];
}

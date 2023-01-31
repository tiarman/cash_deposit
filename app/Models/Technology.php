<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $table = 'technologies';

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by'
    ];

    public static $statusArrays = ['inactive', 'active'];
}

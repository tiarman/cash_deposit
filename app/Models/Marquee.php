<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marquee extends Model
{
    use HasFactory;
    protected $table = 'marquees';
    protected $fillable = [
        'headline',
        'status'
    ];

    public static $statusArrays = ['active','inactive'];
}

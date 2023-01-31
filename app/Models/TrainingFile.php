<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingFile extends Model
{
    use HasFactory;
    protected $table = 'training_files';

    protected $fillable = [
        'training_id',
        'type',
        'name',
        'description',
        'size',
        'file',
    ];
}

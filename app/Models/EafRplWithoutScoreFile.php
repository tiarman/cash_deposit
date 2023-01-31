<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EafRplWithoutScoreFile extends Model
{
    use HasFactory;
    protected $table = 'eaf_rpl_without_score_files';
    protected $fillable = [
      'form_id',
      'type',
      'name',
      'description',
      'size',
      'file',
    ];
}

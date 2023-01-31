<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EafShortCourseFile extends Model
{
  protected $table = 'eaf_short_course_files';

  protected $fillable = [
    'form_id',
    'type',
    'name',
    'description',
    'size',
    'file',
  ];
}

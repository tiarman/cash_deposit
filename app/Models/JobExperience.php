<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobExperience extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'name',
      'organization_name',
      'designation',
      'start_date',
      'end_date',
      'contact_name',
      'contact_phone',
      'contact_designation',
      'contact_email',
      'status',
    ];
    public static $statusArrays = ['inactive', 'active' ,'rejected'];
}

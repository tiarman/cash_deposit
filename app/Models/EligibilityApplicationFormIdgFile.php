<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EligibilityApplicationFormIdgFile extends Model {
  use HasFactory;

  protected $table = 'eligibility_application_form_idg_files';

  protected $fillable = [
    'form_id',
    'type',
    'name',
    'description',
    'size',
    'file',
  ];

}

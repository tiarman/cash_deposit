<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
  use HasFactory;

  protected $table = 'notifications';
  protected $fillable = [
    'user_id',
    'type',
    'title',
    'message',
    'is_read',
    'is_deleted'
  ];

  public static $types = ['training', 'registration'];


}

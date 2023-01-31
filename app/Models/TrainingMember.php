<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingMember extends Model {
  use HasFactory;

  protected $table = 'training_members';
  protected $fillable = [
    'training_id', 'name', 'email', 'phone', 'user_id', 'replace_by', 'replace_from',
    'institute_head_id',
    'institute_head_approve_at',
    'institute_head_approve_status',
    'batch_creator_id',
    'batch_creator_approve_at',
    'batch_creator_approve_status',
    'batch_approver_id',
    'batch_approver_approve_at',
    'batch_approver_approve_status',
    'status'
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function training(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(Training::class, 'training_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function head(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'institute_head_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'batch_creator_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function approver(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'batch_approver_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function replacedby(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'replace_by');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function replacedfrom(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(User::class, 'replace_from');
  }


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function ptraining(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(TrainingMember::class, 'user_id', 'user_id');
  }


  public static $statusArrays = ['inactive', 'active', 'rejected', 'replaced'];
  public static $approvalArrays = ['accepted', 'rejected'];
}

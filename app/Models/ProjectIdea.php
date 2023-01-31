<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectIdea extends Model
{
    use HasFactory;

    protected $table = 'project_ideas';


    protected $fillable = [
        'project_id',
        'user_id',
        'institute_id',
        'title',
        'title_bn',
        'keyword',
        'short_description',
        'short_description_bn',
        'description',
        'description_bn',
        'benefits',
        'implementation_location',
        'expenses',
        'instrument_details',
        'status',
        'year',
        'hod_approval_add',
        'hod_approval',
        'vp_approval_add',
        'vp_approval',
        'p_approval_add',
        'p_approval',
        'pmu_approval_add',
        'pmu_approval',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(User::class, 'institute_id', 'id');
    }

    public function files(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(ProjectIdeaFile::class);
    }
    public function institute() {
        return $this->belongsTo(Institute::class,'institute_id','id');
    }
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public static $statusArrays = ['inactive', 'active'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectIdeaMember extends Model
{
    use HasFactory;
    protected $table = 'project_idea_members';
    protected $fillable = [
        'project_idea_id',
        'user_id',
        'type',
        'technology',
        'semester',
        'board_roll'
    ];

    public function projectIdea(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(ProjectIdea::class,'project_idea_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }

    public static $memberTypeArrays = ['Team Leader', 'Member One', 'Member Two' ];

}

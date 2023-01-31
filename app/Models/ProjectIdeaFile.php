<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectIdeaFile extends Model
{
    use HasFactory;
    protected $table = 'project_idea_files';
    protected $fillable = [
        'project_idea_id',
        'type',
        'name',
        'size',
        'description',
        'file'
    ];

    public function projectIdea(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(ProjectIdea::class,'project_idea_id');
    }
}

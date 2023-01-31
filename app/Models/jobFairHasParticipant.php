<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class jobFairHasParticipant extends Model
{
    use HasFactory;

    protected $table = 'job_fair_has_participants';

    protected $fillable = [
        'event_id',
        'participant_id',
        'status'
    ];

    public static $status = ['pending', 'accepted', 'reject'];

    public function jobEvent(){
        return $this->belongsTo(JobEvent::class,'job_event_id','id');
    }
    public function participant(){
        return $this->belongsTo(User::class,'participant_id','id');
    }
}

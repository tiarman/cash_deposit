<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentInterest extends Model
{
    use HasFactory;

    protected $table = "agent_interests";

    protected $fillable = [
        'agent_id',
        'interest_amount'
    ];
}

?>

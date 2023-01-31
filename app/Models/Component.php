<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $table = 'components';
    protected $fillable = [
        'name',
        'code',
        'created_by',
        'updated_by',
    ];


    public function subcomponents(){
        return $this->hasMany(SubComponent::class,'component_id', 'id');
    }



    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function editor(){
        return $this->belongsTo(User::class,'updated_by');
    }


}

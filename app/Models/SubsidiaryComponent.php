<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsidiaryComponent extends Model
{
    use HasFactory;

    protected $table = 'subsidiary_components';
    protected $fillable = [
        'componet_id',
        'sub_component_id',
        'name',
        'code',
        'created_by',
        'updated_by',
    ];


    public function voucherinfo(){
        return $this->hasMany(VoucherDetails::class,'subsidiary_component_id');
    }

    public function component(){
        return $this->belongsTo(Component::class,'component_id');
    }
    public function subcomponent(){
            return $this->belongsTo(SubComponent::class,'sub_component_id');
        }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function editor(){
        return $this->belongsTo(User::class,'updated_by');
    }
}

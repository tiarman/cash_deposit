<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payments";
   protected $fillable = [
    'name',
    'name_key',
    'user_id',
    'mobile',
    'image',
    'payment_number_id',
    'status',
   ];
   public static $statusArray = ['active','inactive'];
   public static $paymentMethods = [
    'bkash_agent' => 'Bkash Agent',
    'bkash_personal' => 'Bkash Personal',
    'nagad_personal' => 'Nagad Personal',
    'rocket_personal' => 'Rocket Personal',
    'upay_personal' => 'Upay Personal',
   ];
   public function numbers(){
       $data['user'] = User::whereHas('roles',function( $user){$user->where('roles.name','Super Admin');})->first();
       $adminId = $data['user']->id;
    return $this->hasMany(Payment_number::class,'method_id','id')->where('user_id',$adminId);
   }
   public function agentsNumbers(){
    return $this->hasMany(Payment_number::class,'method_id','id')->where('user_id', auth()->id());
   }


}

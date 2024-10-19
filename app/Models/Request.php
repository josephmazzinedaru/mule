<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Request extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [''];


    public function oneuser(){
        return $this->hasOne(User::class,'id','user_id');
    }


}

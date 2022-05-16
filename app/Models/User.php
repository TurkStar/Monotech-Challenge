<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{

    use HasFactory;

    protected $table = 'users';

    protected $hidden = ['pivot', 'created_at', 'updated_at'];
   
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email'
    ];

   
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'user_promotions');
    }

    public function wallet()
    {
        return $this->hasMany(Wallet::class);
    }
}

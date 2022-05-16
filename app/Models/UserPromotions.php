<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPromotions extends Model
{
    use HasFactory;

    protected $table = 'user_promotions';

    protected $guarded = [];
}

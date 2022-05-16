<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'code',
        'start_date',
        'end_date',
        'amount',
        'quota'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_promotions');
    }
}

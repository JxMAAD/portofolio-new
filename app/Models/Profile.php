<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'title',
        'bio',
        'photo',
        'cv',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

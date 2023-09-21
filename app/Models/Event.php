<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'description',
        'lat',
        'lng',
        'user_id',
        'is_confirmed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

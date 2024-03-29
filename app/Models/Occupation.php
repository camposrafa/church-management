<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occupation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'desc',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberOccupation extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'member_id', 'occupation_id',
    ];

    public function members()
    {
        return $this->belongsTo(Member::class);
    }

    public function occupations()
    {
        return $this->belongsTo(Occupation::class);
    }
}

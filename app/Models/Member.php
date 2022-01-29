<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'picture',
        'birth_date',
        'occupations',
        'cpf',
        'phone',
        'address',
        'neighborhood',
        'number',
        'postal_code',
        'father_name',
        'mother_name',
        'spouse',
        'wedding_date',
        'qtty_sons',
        'civil_state_id',
    ];

    public function occupations()
    {
        return $this->belongsToMany(Occupation::class);
    }

    public function civilState()
    {
        return $this->belongsTo(CivilState::class);
    }

    public function picture()
    {
        return $this->belongsTo(File::class);
    }
}

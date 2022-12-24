<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'sem',
        'grade',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

}

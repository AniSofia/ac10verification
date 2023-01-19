<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muet extends Model
{
    use HasFactory;

    protected $table = 'muets';

    protected $fillable = [
        'user_id',
        'band',
    ];
}

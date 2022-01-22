<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['dni', 'names', 'email', 'age', 'photo'];

    protected $hidden = ['created_at', 'updated_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    const ADMIN_ROLE = 1;
    const MODERATOR_ROLE = 2;
    const USER_ROLE = 3;

    protected $fillable = ["name"];
}

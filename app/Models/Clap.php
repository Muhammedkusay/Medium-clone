<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clap extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = ['user_id', 'post_id'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;

    protected $table = 'residence';
}

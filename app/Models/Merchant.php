<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $table = 'merchant';
}

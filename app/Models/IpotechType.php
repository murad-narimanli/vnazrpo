<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class IpotechType extends Model
{
    use HasFactory;

    protected $table = 'ipotech-type';
}
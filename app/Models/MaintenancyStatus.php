<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class MaintenancyStatus extends Model
{
    use HasFactory;

    protected $table = 'maintenancy-status';
}

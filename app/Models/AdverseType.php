<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class AdverseType extends Model
{
    use HasFactory;

    protected $table = 'adverse-type';
}

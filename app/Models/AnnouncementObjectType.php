<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class AnnouncementObjectType extends Model
{
    use HasFactory;

    protected $table = 'anouncement-object-type';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceSession extends Model
{
    protected $table = "device_sessions";

    protected $fillable = ['user_id', 'session_id', 'browser', 'os', 'device', 'is_mobile'];
}

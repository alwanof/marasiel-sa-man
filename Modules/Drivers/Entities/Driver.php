<?php

namespace Modules\Drivers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Driver extends Model
{
    use Notifiable;
    protected $guarded = [];
    protected $appends = ['avatar'];

    public function getAvatarAttribute()
    {
        $path = file_exists(public_path().'/modules/drivers/uploads/drivers/' . $this->hash . '.jpg');
        $avatar = ($path) ? asset('modules/drivers/uploads/drivers/' . $this->hash . '.jpg') : asset('modules/drivers/uploads/drivers/0.jpg');
        return $avatar;
    }

}

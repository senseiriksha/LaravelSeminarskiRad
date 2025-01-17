<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function navigations()
    {
        return $this->belongsTo(Navigation::class, 'navigation_id');
    }
}

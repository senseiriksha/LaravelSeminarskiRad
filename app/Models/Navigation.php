<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duedate'
    ];
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}


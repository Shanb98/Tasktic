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
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}


<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'username', 'position','project_id'];
    protected $attributes = [
        'project_id' => null, // Default to null if not provided
    ];
    // Define inverse relationship with Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

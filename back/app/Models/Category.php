<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'project_id'];

    // Define inverse relationship with Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

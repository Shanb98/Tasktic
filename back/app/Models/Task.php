<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description','type', 'project_id','category_id','employee_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

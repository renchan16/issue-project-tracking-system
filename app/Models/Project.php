<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Get the issues for the project.
     */
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
    
    /**
     * Get the users associated with the project.
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user_pivot');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Collaborator extends Model
{
    use HasFactory;
    protected $fillable= ['todo_id','user_id','status'];
    protected $table = 'collaborators';


    public function todo(): BelongsToMany
    {
        return $this->belongsToMany(Todo::class, 'todo_id');
    }

    // public function user()
    // {
    //     return $this->hasOne(User::class, 'user_id');
    // }

}

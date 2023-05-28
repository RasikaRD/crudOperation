<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Todo extends Model
{
    use HasFactory, Notifiable;
    protected $fillable= ['title','user_id'];
    protected $table = 'todos';

    public function todolist(){
        return $this->hasMany(Todolist::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function collaborators()
    {
        return $this->belongsToMany(Collaborator::class, 'collaborators', 'todo_id', 'user_id');
    }
    

}

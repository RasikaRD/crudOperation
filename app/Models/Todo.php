<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable= ['title'];
    protected $table = 'todos';

    public function todolist(){
        return $this->hasMany(Todolist::class);
    }

}

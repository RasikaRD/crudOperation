<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;
    protected $fillable = ['contents','todo_id','done','user_id'];
    public function validationRules(){
        return ['contents' =>  'required'];
    }
    public function todo()
    {
        return $this->belongsTo(Todo::class , 'todo_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }



}

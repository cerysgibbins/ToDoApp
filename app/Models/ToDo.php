<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model 
{
    const TODO_STATUS_UNCOMPLETE = 0;
    
    const TODO_STATUS_COMPLETE = 1;

    protected $fillable = ['note', 'due_date', 'status'];
}

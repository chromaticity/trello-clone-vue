<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    //
    use SoftDeletes;

	$table = "tasks";

	$fillable = ['name', 'category_id', 'user_id', 'order'];


	// ---- Relationships ---- //

	public function user() 
	{
		return $this->belongsTo(User::class);
	}

	public function category()
	{
		return $this->hasOne(Task::class);
	}

}

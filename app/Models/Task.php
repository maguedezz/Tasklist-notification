<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Whenever I retrieve due_date, make sure it's treated as a real date, not just text
    
    protected $casts = ['due_date' => 'date'];
    protected $fillable = ['user_id', 'is_completed' ,'title', 'due_date','priority'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

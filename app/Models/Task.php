<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'assignment_date'];
    protected $casts = [
        'assignment_date' => 'datetime',
        'deadline' => 'datetime',
    ];
    public function category() { return $this->belongsTo(Category::class); }
    public function user() { return $this->belongsTo(User::class); }
}

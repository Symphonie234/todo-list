<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_done',
        'due_date',
        'priority'
    ];

    protected $casts = [
        'is_done' => 'boolean',
        'due_date' => 'date',
    ];
}

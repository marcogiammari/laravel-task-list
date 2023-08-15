<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // questa proprietà permette il mass asssignment nel create e nell'update
    protected $fillable = [
        'title',
        'description',
        'long_description'
    ];
}

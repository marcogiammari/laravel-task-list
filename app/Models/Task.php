<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // questa proprietà permette il mass asssignment nel create e nell'update. non aggiungere dati sensibili in queste proprietà
    protected $fillable = [
        'title',
        'description',
        'long_description'
    ];

    public function toggleComplete()
    {
        $this->completed = !$this->completed;
        $this->save();
    }
}

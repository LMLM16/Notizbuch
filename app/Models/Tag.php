<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    public function notes() : BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'note__tags', 'tag_id', 'note_id');
    }

    public function todos() : BelongsToMany
    {
        return $this->belongsToMany(Todo::class, 'todo__tags', 'tag_id', 'todo_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','title', 'subtitle','content', 'published','rating','updated_at','list_id'
    ];

    public function isFavourite() : bool {
        return $this->rating >= 8;
    }

    public function scopeFavourite($query){
        return $query->where('rating','>=',8);
    }

    public function images() : HasMany {
        return $this->hasMany(Image::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function todo() : HasMany {
        return $this->hasMany(Todo::class);
    }

    public function tags() : BelongsToMany {
        return $this->belongsToMany(Tag::class, 'note__tags', 'note_id', 'tag_id');
    }

    public function lists() : BelongsTo {
        return $this->belongsTo(Liste::class, 'list_id');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Liste extends Model
{
    use HasFactory;
    // Definiere die Felder, die massenzuweisbar sein sollen
    protected $fillable = ['name', 'user_id','is_public'];
    protected $table = 'lists';
    /**
     * Eine Liste gehört zu einem Benutzer.
     */
    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Eine Liste kann viele Notizen haben.
     */
    public function notes() : HasMany {
        return $this->hasMany(Note::class,'list_id');
    }


}

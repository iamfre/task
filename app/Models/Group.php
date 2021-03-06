<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'groups';

    /**
     * Пользователи, принадлежащие к группам.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('expired_at');
    }
}

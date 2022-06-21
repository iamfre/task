<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'users';

    /**
     * Группы, принадлежащие пользователю.
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class)->withPivot('expired_at');
    }
}

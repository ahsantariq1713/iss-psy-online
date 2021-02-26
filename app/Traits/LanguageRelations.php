<?php
namespace App\Traits;
use App\Models\User;
trait LanguageRelations
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_language');
    }
}

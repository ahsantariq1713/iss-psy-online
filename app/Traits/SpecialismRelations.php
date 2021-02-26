<?php


namespace App\Traits;

use App\Models\SpecialismCategory;
use App\Models\User;

trait SpecialismRelations
{
    public function specialismCategory()
    {
        return $this->belongsTo(SpecialismCategory::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class , 'specialism_user');
    }

}

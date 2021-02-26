<?php


namespace App\Traits;

use App\Models\Specialism;

trait SpecialismCategoryRelations
{
    public function specialisms()
    {
        return $this->HasMany(Specialism::class);
    }
}

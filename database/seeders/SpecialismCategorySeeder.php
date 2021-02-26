<?php

namespace Database\Seeders;

use App\Models\SpecialismCategory;
use Illuminate\Database\Seeder;

class SpecialismCategorySeeder extends Seeder
{
    public function run()
    {
        SpecialismCategory::factory(['name' => 'Abuse'])->create();
        SpecialismCategory::factory(['name' => 'Addiction'])->create();
        SpecialismCategory::factory(['name' => 'Anger'])->create();
        SpecialismCategory::factory(['name' => 'Anxiety / stress'])->create();
        SpecialismCategory::factory(['name' => 'Conduct disorders'])->create();
        SpecialismCategory::factory(['name' => 'Depression'])->create();
        SpecialismCategory::factory(['name' => 'Developmental disorders'])->create();
        SpecialismCategory::factory(['name' => 'Dissociative disorders'])->create();
        SpecialismCategory::factory(['name' => 'Eating'])->create();
        SpecialismCategory::factory(['name' => 'Education'])->create();
        SpecialismCategory::factory(['name' => 'Family'])->create();
        SpecialismCategory::factory(['name' => 'Grief / loss'])->create();
        SpecialismCategory::factory(['name' => 'Health related issues (physical)'])->create();
        SpecialismCategory::factory(['name' => 'Identity'])->create();
        SpecialismCategory::factory(['name' => 'Mood'])->create();
        SpecialismCategory::factory(['name' => 'Obsessive compulsive disorders'])->create();
        SpecialismCategory::factory(['name' => 'Personal'])->create();
        SpecialismCategory::factory(['name' => 'Personality disorders'])->create();
        SpecialismCategory::factory(['name' => 'Relationships'])->create();
        SpecialismCategory::factory(['name' => 'Schizophrenia / psychosis'])->create();
        SpecialismCategory::factory(['name' => 'Sexual difficulties'])->create();
        SpecialismCategory::factory(['name' => 'Paraphilias'])->create();
        SpecialismCategory::factory(['name' => 'Sleep concerns'])->create();
        SpecialismCategory::factory(['name' => 'Somatic'])->create();
        SpecialismCategory::factory(['name' => 'Trauma'])->create();
        SpecialismCategory::factory(['name' => 'Work'])->create();
    }
}

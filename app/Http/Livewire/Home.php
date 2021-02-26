<?php

namespace App\Http\Livewire;

use App\Models\SpecialismCategory;
use Livewire\Component;

class Home extends Component
{
    public $helpTags;
    public function search()
    {
        $route = route('search');
        $payload = json_encode($this->helpTags);
        $url = "{$route}?helpTags={$payload}";
        return redirect($url);
    }
    public function render()
    {
        $categories = SpecialismCategory::with('specialisms')->get();
        return view('livewire.home.home', compact('categories'))->extends('layouts.site');
    }
}

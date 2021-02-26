<?php

namespace App\Http\Livewire;

use App\Helpers\ProfileLogStatus;
use App\Helpers\UserRoles;
use App\Models\SpecialismCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Search extends Component
{
    public $visitortz, $timezone, $country;
    public $categories, $specialisms = [], $genders = ['Male', 'Female', 'Other'], $languages = [], $priceSort = 'asc';
    public  $page = 1 ,$total, $totalPages, $next, $prev, $perPage = 10;

    public function updated($proeprty)
    {
        if ($proeprty == 'timezone' || $proeprty == 'country') {
            $this->visitortz = Auth::check() ?  Auth::user()->timezone : $this->timezone;
        }

        $this->total = 0;
    }

    public function mount()
    {
        $payload= request()->get("helpTags");
        if(not_null($payload)){
            $this->specialisms = json_decode($payload);
        }
        $this->categories = SpecialismCategory::with('specialisms')->get();
    }

    public function showNext()
    {
        $this->page += 1;
    }

    public function showPrev()
    {
        $this->page -= 1;
    }

    public function render()
    {
        $therapists = [];
        if ($this->visitortz) {
            $specialisms = $this->specialisms;
            $languages = $this->languages;
            $priceSort = $this->priceSort;
            $query =
                User::where('role', UserRoles::THERAPIST)
                ->whereHas('profileLog', function ($profileLog) {
                    return $profileLog->where('status', ProfileLogStatus::APPROVED);
                })
                ->whereHas('specialisms', function ($query)  use ($specialisms) {
                    return (is_null($specialisms) || count($specialisms) <= 0)
                        ? true
                        : $query->whereIn('specialism_id', $specialisms);
                })
                ->whereHas('languages', function ($query)  use ($languages) {
                    return (is_null($languages) || count($languages) <= 0)
                        ? true
                        : $query->whereIn('language_id', $languages);
                })
                ->whereIn('gender', $this->genders)
                ->with(['roster', 'license', 'pricing', 'profileLog', 'sessions']);

            if ($this->total == 0) {
                $this->total =  $query->count();
                $this->page = 1;
            }

            if($this->total > 0){
                $this->totalPages = $this->total / $this->perPage;
            }

            $therapists = $query
                ->whereHas('pricing', function ($query) use ($priceSort) {
                    $query->orderBy('fee', $priceSort);
                })
                ->skip(($this->page - 1) * $this->perPage)
                ->limit($this->perPage)
                ->get();

            $this->next = $this->page < $this->totalPages;
            $this->prev = $this->page > 1;
        }

        return view('livewire.search', compact('therapists'))->extends('layouts.site');
    }
}

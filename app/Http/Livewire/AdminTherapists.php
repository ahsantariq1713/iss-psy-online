<?php

namespace App\Http\Livewire;

use App\Helpers\UserRoles;
use App\Models\User;
use Livewire\Component;

class AdminTherapists extends Component
{
    public $search = [];

    public function mount(){
        $this->search['param'] = 'name';
        $this->search['input'] = '';
        $this->search['status'] = request()->profileStatus ?? '';
        $this->search['sortMode'] = 'asc';
        $this->search['sortBy'] = 'name';
    }

    protected $rules = [
        'search.param' => 'required',
        'search.input' => 'nullable',
        'search.status' => 'nullable',
        'search.sortMode' => 'required',
        'search.sortBy' => 'required'
    ];


    

    public function render()
    {

        $query = User::with(['pricing', 'profileLog', 'roster'])->where('role', UserRoles::THERAPIST);

        //search param with input
        $query = $query->where($this->search['param'], 'like' , '%' . $this->search['input'] . '%');

        //profile status
        $query = $query->whereHas('profileLog', function($profileLog){
            return $profileLog->where('status', 'like' , '%' . $this->search['status'] . '%');
        });

        //sortBy with sortMode
        $therapists = $query->get();

        $therapists = $this->search['sortMode'] == 'asc' ? $therapists->sortBy($this->search['sortBy']) : $therapists->sortByDesc($this->search['sortBy']);


        return view('livewire.admin-therapists', compact('therapists'))->extends('layouts.dashboard');
    }
}

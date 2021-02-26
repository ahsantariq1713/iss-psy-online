<?php

namespace App\Http\Livewire;

use App\Helpers\AssociateHelper;
use App\Models\Education;
use App\Traits\SwalEmitter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Educations extends Component
{
    use SwalEmitter, AuthorizesRequests;

    public $educations, $education, $new = false;

    protected $rules = [
        'education.degree' => 'required',
        'education.specialization' => 'nullable',
        'education.institute' => 'required',
        'education.year' => 'required'
    ];

    public function mount()
    {
        $this->educations = Auth::user()->educations;
    }

    public function add()
    {
        $this->new = true;
        $this->education = new Education();
        $this->clearValidation();
        $this->emit('entity-modal');
    }

    public function edit($id)
    {
        $this->new = false;
        $this->education = Education::find($id);
        if ($this->education == null) {
            $this->swalAlert('error', 'Not Found', 'Resource not found', null, 1500);
            return null;
        }
        $this->clearValidation();
        $this->emit('entity-modal');
    }

    public function save()
    {
        $this->validate();

        if (not_null($this->education->id)) {
            $this->authorize('update', $this->education);
        }

        AssociateHelper::ensureUserAssociated($this->education, Auth::user());
        $this->education->save();
        if ($this->new) {
            $this->educations->add($this->education);
        } else {
            $this->educations->where('id', $this->education->id)->first()->refresh();
        }

        $this->emit('entity-modal');

        Auth::user()->profileLog->update(['education' => true]);

        $this->emit('refreshProfileLog');

        $this->swalAlert('success', 'Awesome', 'Education saved successfully', "Ok", 1500);
    }

    public function delete()
    {
        $this->authorize('delete', $this->education);

        $this->educations = $this->educations->filter(function ($item) {
            return $item->id != $this->education->id;
        });

        $this->education->delete();

        if ($this->educations->count() <= 0) {
            Auth::user()->profileLog->update(['education' => false]);
        }

        $this->emit('refreshProfileLog');

        $this->swalAlert('success', 'Awesome', 'Education deleted successfully', "Ok", 1500);

        $this->emit('entity-modal');

    }

    public function render()
    {
        return view('livewire.educations');
    }
}

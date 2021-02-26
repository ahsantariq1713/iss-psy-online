<?php

namespace App\Http\Livewire;

use App\Helpers\AssociateHelper;
use App\Models\Experience;
use App\Traits\SwalEmitter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Experiences extends Component
{
    use SwalEmitter, AuthorizesRequests;

    public $experiences, $experience, $new = false;

    protected $messages = [
        'experience.start.integer' => 'Start year must be a year',
        'experience.end.integer' => 'End year must be a year'
    ];

    protected $attributes = [
        'experience.start' => 'start year',
        'experience.end' => 'end year',
    ];

    protected $rules = [
        'experience.location' => 'required',
        'experience.designation' => 'required',
        'experience.start' => 'required|integer',
        'experience.end' => 'required|integer'
    ];

    public function mount()
    {
        $this->experiences = Auth::user()->experiences;
    }

    public function add()
    {
        $this->new = true;
        $this->experience = new Experience();
        $this->clearValidation();
        $this->emit('entity-modal');
    }

    public function edit($id)
    {
        $this->new = false;
        $this->experience = Experience::find($id);
        if ($this->experience == null) {
            $this->swalAlert('error', 'Not Found', 'Resource not found', null, 1500);
            return null;
        }
        $this->clearValidation();
        $this->emit('entity-modal');
    }

    public function save()
    {
        $this->validate();
        if($this->experience->end < $this->experience->start){
            $this->swalAlert('warning', 'Invalid Data', 'End year cannot be less than start year', "Ok", 1500);
            return null;
        }

        if (not_null($this->experience->id)) {
            $this->authorize('update', $this->experience);
        }

        AssociateHelper::ensureUserAssociated($this->experience, Auth::user());

        $this->experience->save();
        if ($this->new) {
            $this->experiences->add($this->experience);
        } else {
            $this->experiences->where('id', $this->experience->id)->first()->refresh();
        }

        $this->emit('entity-modal');

        Auth::user()->profileLog->update(['experience' => true]);

        $this->emit('refreshProfileLog');

        $this->swalAlert('success', 'Awesome', 'Experience saved successfully', "Ok", 1500);
    }

    public function delete()
    {
        $this->authorize('delete', $this->experience);

        $this->experiences = $this->experiences->filter(function ($item) {
            return $item->id != $this->experience->id;
        });

        $this->experience->delete();

        if ($this->experiences->count() <= 0) {
            Auth::user()->profileLog->update(['experience' => false]);
        }

        $this->emit('refreshProfileLog');

        $this->swalAlert('success', 'Awesome', 'Experience deleted successfully', "Ok", 1500);

        $this->emit('entity-modal');

    }

    public function render()
    {
        return view('livewire.experiences');
    }
}

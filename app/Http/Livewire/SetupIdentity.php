<?php

namespace App\Http\Livewire;

use App\Helpers\AssociateHelper;
use App\Helpers\DocumentStorage;
use App\Models\Identity;
use App\Traits\SwalEmitter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SetupIdentity extends Component
{
    use SwalEmitter, WithFileUploads, AuthorizesRequests;

    public $identity, $nat_doc, $drv_license_doc, $passport_doc;

    protected $rules = [
        'identity.nat_id' => 'required',
        'identity.drv_license_no' => 'nullable',
        'identity.passport_no' => 'nullable',
        'nat_doc' => 'max:3072',
        'passport_doc' => 'max:3072',
        'drv_license_doc' => 'max:3072',
    ];

    public function mount()
    {
        $this->identity = Auth::user()->identity ?? new Identity();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        if(not_null($this->identity->id)){
            $this->authorize('update', $this->identity);
        }

        $this->validate();

        if ($this->identity->nat_doc == null) {
            $this->validate([
                'nat_doc' => 'required|max:3072',
            ]);
        }

        if ($this->identity->passport_no == null && $this->identity->drv_license_no == null) {
            $this->swalAlert('warning', 'Invalid Data', 'Please provide passport no or driver\'s license no');
            return null;
        }

        if ($this->identity->passport_no != null && $this->identity->passport_doc == null) {
            $this->validate([
                'passport_doc' => 'required|max:3072',
            ]);
        }

        if ($this->identity->drv_license_no != null && $this->identity->drv_license_doc == null) {
            $this->validate([
                'drv_license_doc' => 'required|max:3072',
            ]);
        }

        DocumentStorage::store($this->identity,'nat_doc', $this->nat_doc,Auth::id());
        DocumentStorage::store($this->identity,'passport_doc', $this->passport_doc,Auth::id());
        DocumentStorage::store($this->identity,'drv_license_doc', $this->drv_license_doc,Auth::id());

        AssociateHelper::ensureUserAssociated($this->identity,Auth::user());
        $this->identity->save();
        Auth::user()->profileLog->update(['identity'=> true]);

        $this->swalRedirect('success', 'Awesome!', 'Identity  saved successfully', route('therapist.professional-profile', ['license']), false, 1500);
    }

    public function export($property)
    {
        $this->authorize('download', $this->identity);
        return Storage::disk('local')->download($this->identity[$property]);
    }

    public function render()
    {
        return view('livewire.setup-identity');
    }
}

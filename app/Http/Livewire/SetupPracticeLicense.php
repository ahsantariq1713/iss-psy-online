<?php

namespace App\Http\Livewire;

use App\Helpers\AssociateHelper;
use App\Helpers\DocumentStorage;
use App\Models\Language;
use App\Models\PracticeLicense;
use App\Traits\SwalEmitter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SetupPracticeLicense extends Component
{
    use SwalEmitter, WithFileUploads, AuthorizesRequests;

    public $license, $license_doc;
    public $languages=[], $myLanguages = [];
    protected $rules = [
        'license.about' => 'required|min:150|max:500',
        'license.video_url' => 'nullable',
        'license.academic_title' => 'required',
        'license.experience' => 'required',
        'license.type' => 'required',
        'license.reference' => 'required',
        'license_doc' => 'max:3072',
        'myLanguages' => 'required'
    ];

    public function mount()
    {
        $this->languages = Language::all();
        $this->myLanguages = Auth::user()->languages->pluck('id');
        $this->license = Auth::user()->license ?? new PracticeLicense();
        DocumentStorage::store($this->license, 'license_doc', $this->license_doc, Auth::id());
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {

        if(not_null($this->license->id)) {
            $this->authorize('update', $this->license);
        }
        $this->validate();

        if(is_null(Auth::user()->specialisms) || Auth::user()->specialisms->count() == 0){
            $this->swalAlert('warning','Specialities Required', 'Select your specialities to submit license');
            return null;
        }

        if ($this->license->license_doc == null) {
            $this->validate(['license_doc' => 'required|max:3072']);
        }


        if( strpos($this->license->video_url, 'watch?v=') !== false){
            $this->license->video_url = str_replace('watch?v=', 'embed/' ,$this->license->video_url);
        }

        DocumentStorage::store($this->license, 'license_doc', $this->license_doc, Auth::id());

        AssociateHelper::ensureUserAssociated($this->license, Auth::user());

        $this->license->save();

        Auth::user()->profileLog->update(['license' => true]);

        Auth::user()->languages()->detach();
        Auth::user()->languages()->attach($this->myLanguages);

        $this->swalRedirect('success', 'Awesome!', 'Practitioner License  saved successfully', route('therapist.professional-profile', ['education']), false, 1500);
    }

    public function export($property)
    {
        $this->authorize('download', $this->license);
        return Storage::disk('local')->download($this->license[$property]);
    }

    public function render()
    {
        return view('livewire.setup-practice-license');
    }
}

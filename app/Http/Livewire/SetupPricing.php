<?php

namespace App\Http\Livewire;

use App\Helpers\AssociateHelper;
use App\Models\Pricing;
use App\Traits\SwalEmitter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetupPricing extends Component
{
    use SwalEmitter, AuthorizesRequests;

    public $pricing;

    protected $rules = [
        'pricing.fee' => 'required|integer'
    ];

    public function mount()
    {
        $this->pricing = Auth::user()->pricing;
        if ($this->pricing == null) {
            $this->pricing = new Pricing(['fee' => 35]);
            AssociateHelper::ensureUserAssociated($this->pricing, Auth::user());
            $this->pricing->save();
        }
    }

    public function update()
    {
        $this->authorize('update',$this->pricing);
        $this->pricing->save();
        Auth::user()->profileLog->update(['pricing' => true]);
        $this->swalRedirect('success', 'Awesome!', 'Pricing setup completed successfully', route('therapist.professional-profile', ['payment']), false, 1500);
        // $this->swalRedirect('success', 'Awesome!', 'Pricing setup completed successfully', '/dashboard', false, 1500);
    }

    public function render()
    {
        return view('livewire.setup-pricing');
    }
}

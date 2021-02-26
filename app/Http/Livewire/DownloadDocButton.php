<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DownloadDocButton extends Component
{

    use AuthorizesRequests;

    public $obj,$property;

    public function export()
    {
        $this->authorize('download', $this->obj);
        return Storage::disk('local')->download($this->obj[$this->property]);
    }

    public function render()
    {
        return view('livewire.download-doc-button');
    }
}

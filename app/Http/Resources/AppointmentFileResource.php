<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'by' => $this->user->name,
            'author_role' => $this->user->role,
            'title' => $this->title,
            'date' => $this->created_at->calendar(),
            'download_url' => route('appointment.download-file', [$this]),
            'delete_url' => route('appointment.delete-file', [$this]),
            'can_deleted' => $this->user->id == auth()->id()
        ];
    }
}

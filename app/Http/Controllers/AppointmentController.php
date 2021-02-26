<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentFileResource;
use App\Models\Appointment;
use App\Models\AppointmentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppointmentController extends Controller
{
    public function postRecommendations(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        if (not($appointment->active())) {
            return back();
        }
        // $this->authorize('recommendations', $appointment);
        $appointment->recommendations = $request->recommendations;
        $appointment->save();
        return response()->json([], 200);
    }

    public function postNotes(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        if (not($appointment->active())) {
            return back();
        }
        // $this->authorize('recommendations', $appointment);
        $appointment->notes = $request->notes;
        $appointment->save();
        return response()->json([]);
    }

    public function uploadFiles(Request $request, Appointment $appointment)
    {
        if (not($appointment->active())) {
            return back();
        }
        //the authenticatd user
        $user = auth()->user();

        //get all files uploaded
        $file = $request->file('test');

        //loop through each file and save fil
        $file_name = $file->getClientOriginalName();
        $content = file_get_contents($file);
        $path = 'appointment-' . $appointment->id . '/' . time() . $file_name;
        Storage::disk()->put($path, $content);

        //create appointment files for uploaded file
        $appointment_file = new AppointmentFile([
            'title' => $file_name,
            'file' => $path
        ]);
        $appointment_file->user()->associate($user);
        $appointment_file->appointment()->associate($appointment);
        $appointment_file->save();

        //create resources and return json result
        $resources =  new AppointmentFileResource($appointment_file);
        return response()->json($resources);
    }

    public function downloadFile(AppointmentFile $appointment_file)
    {

        return Storage::download($appointment_file->file);
    }

    public function deleteFile(AppointmentFile $appointment_file)
    {
        // $this->authorize('delete', $appointment_file);
        if (not($appointment_file->appointment->active())) {
            return back();
        }
        $id = $appointment_file->id;
        Storage::delete($appointment_file->file);
        $appointment_file->delete();

        //return success response
        return response()->json($id);
    }
}

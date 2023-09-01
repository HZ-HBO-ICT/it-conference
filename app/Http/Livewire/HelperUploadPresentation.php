<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class HelperUploadPresentation extends Component
{
    use WithFileUploads;

    public $file;
    public $path;

    public function render()
    {
        return view('livewire.helper-upload-presentation');
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => ['required',
                'file',
                'max:10240',
                'mimetypes:application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation',
            ],
        ], [
            'file.required' => 'The file is required',
            'file.max' => 'The file must not be larger than 10MB',
            'file.mimetypes' => 'The file must be a pdf, powerpoint, or presentation document',
        ]);

        Storage::delete('presentations' . explode('@', Auth::user()->email)[0] . '-presentation');
        $this->path = $this->file->storeAs('presentations', explode('@', Auth::user()->email)[0] . '-presentation');
        session()->flash('message', 'Presentation is successfully added.');
    }
}

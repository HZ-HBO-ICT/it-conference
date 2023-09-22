<?php

namespace App\Http\Livewire;

use App\Models\Presentation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadPresentation extends Component
{
    use WithFileUploads;

    public $file;
    public $presentation;
    public $filename;

    public function mount($presentation)
    {
        $this->presentation = $presentation;
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => ['required',
                'file',
                'max:10240',
                'mimetypes:application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation',
            ]
        ], [
            'file.required' => 'The file is required',
            'file.max' => 'The file must not be larger than 10MB',
            'file.mimetypes' => 'The file must be a pdf, powerpoint, or presentation document',
        ]);

        $this->filename = $this->file->getClientOriginalName();
    }

    public function downloadFile()
    {
        return Storage::download($this->presentation->file_path);
    }

    public function save()
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
        $path = $this->file->storeAs('presentations', explode('@', Auth::user()->email)[0] . '-presentation');
        $this->presentation->file_path = $path;
        $this->presentation->save();
        session()->flash('message', 'Presentation is successfully updated.');
    }

    public function delete()
    {
        $this->filename = null;
        $this->file = null;
        Storage::delete('presentations' . explode('@', Auth::user()->email)[0] . '-presentation');
        $this->presentation->file_path = '';
        $this->presentation->save();
        session()->flash('message', 'Presentation is successfully removed.');
    }

    public function render()
    {
        return view('livewire.upload-presentation');
    }
}

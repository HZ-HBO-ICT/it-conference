<?php

namespace App\Livewire\Presentation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadPresentation extends Component
{
    use WithFileUploads;

    public $file;
    public $presentation;
    public $filename;

    /**
     * Triggered when initializing the component
     * @param $presentation
     * @return void
     */
    public function mount($presentation)
    {
        $this->presentation = $presentation;
    }

    /**
     * If a file already is uploaded as presentation, it updates it
     * @return void
     */
    public function updatedFile()
    {
        $this->validate([
            'file' => ['required',
                'file',
                'max:10240',
                'mimetypes:application/pdf,application/vnd.ms-powerpoint,application
                /vnd.openxmlformats-officedocument.presentationml.presentation',
            ]
        ], [
            'file.required' => 'The file is required',
            'file.max' => 'The file must not be larger than 10MB',
            'file.mimetypes' => 'The file must be a pdf, powerpoint, or presentation document',
        ]);

        $this->filename = $this->file->getClientOriginalName();
    }

    /**
     * Downloads the available file
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFile()
    {
        return Storage::download($this->presentation->file_path, $this->presentation->file_original_name);
    }

    /**
     * The presentation is saved
     * @return void
     */
    public function save()
    {
        $this->validate([
            'file' => ['required',
                'file',
                'max:10240',
                'mimetypes:application/pdf,application/vnd.ms-powerpoint,application
                /vnd.openxmlformats-officedocument.presentationml.presentation',
            ],
        ], [
            'file.required' => 'The file is required',
            'file.max' => 'The file must not be larger than 10MB',
            'file.mimetypes' => 'The file must be a pdf, powerpoint, or presentation document',
        ]);

        Storage::delete('presentations' . explode('@', Auth::user()->email)[0] . '-presentation');
        $path = $this->file->storeAs('presentations', explode('@', Auth::user()->email)[0] . '-presentation');
        $this->presentation->file_path = $path;
        $this->presentation->file_original_name = $this->file->getClientOriginalName();
        $this->presentation->save();
        session()->flash('message', 'Presentation is successfully updated.');
    }

    /**
     * Removes the uploaded ifle
     * @return void
     */
    public function delete()
    {
        $this->filename = null;
        $this->file = null;
        Storage::delete('presentations' . explode('@', Auth::user()->email)[0] . '-presentation');
        $this->presentation->file_path = '';
        $this->presentation->file_original_name = '';
        $this->presentation->save();
        session()->flash('message', 'Presentation is successfully removed.');
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.presentation.upload-presentation');
    }
}

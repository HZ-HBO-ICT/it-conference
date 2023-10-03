<?php

namespace App\Http\Livewire;

use App\Models\Presentation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UploadPresentation extends Component
{
    use WithFileUploads;

    public $file;
    public $presentation;
    public $filename;

    /**
     * @param $presentation
     * @return void
     */
    public function mount($presentation): void
    {
        $this->presentation = $presentation;
    }

    /**
     * TODO: Unused function
     * @return void
     */
    public function updatedFile(): void
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

    /**
     * TODO: Unused function
     * Function to download a presentation file from the storage.
     * @return StreamedResponse
     */
    public function downloadFile(): StreamedResponse
    {
        return Storage::download($this->presentation->file_path, $this->presentation->file_original_name);
    }

    /**
     * Function to update an existing presentation file.
     * @return void
     */
    public function save(): void
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
        $this->presentation->file_original_name = $this->file->getClientOriginalName();
        $this->presentation->save();
        session()->flash('message', 'Presentation is successfully updated.');
    }

    /**
     * Function to delete an existing presentation file.
     * @return void
     */
    public function delete(): void
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
     * Renders the presentation file.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.upload-presentation');
    }
}

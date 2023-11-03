<?php

namespace App\Http\Livewire;

use App\Models\Presentation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DownloadPresentation extends Component
{
    public Presentation $presentation;

    public function render()
    {
        return view('livewire.download-presentation');
    }

    public function downloadFile()
    {
        return Storage::download($this->presentation->file_path);
    }
}

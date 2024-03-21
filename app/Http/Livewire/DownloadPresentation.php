<?php

namespace App\Http\Livewire;

use App\Models\Presentation;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DownloadPresentation extends Component
{
    public Presentation $presentation;

    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('livewire.download-presentation');
    }

    /**
     * Provides a way to download the presentation
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFile()
    {
        return Storage::download($this->presentation->file_path);
    }
}

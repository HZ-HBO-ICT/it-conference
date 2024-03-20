<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ManageCompanyLogo extends Component
{
    use WithFileUploads;

    public $photo;
    public $team;

    /**
     * Triggered when initializing the component
     * @param $team
     * @return void
     */
    public function mount($team)
    {
        $this->team = $team;
    }

    /**
     * Renders the component
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:5120',
        ]);
    }

    /**
     * Saves the photo uploaded by the company
     * @return void
     */
    public function save()
    {
        $this->validate([
            'photo' => 'image|max:5120',
        ]);

        $path = $this->photo->store('logos', 'public');
        $this->team->update(['logo_path' => $path]);

        ImageOptimizer::optimize('storage/' . $path);

        $this->reset(['photo']);
        session()->flash('message', 'Logo successfully updated.');
    }

    /**
     * Renders the component
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('livewire.manage-company-logo');
    }
}

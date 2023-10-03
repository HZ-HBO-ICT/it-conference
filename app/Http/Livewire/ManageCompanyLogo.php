<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ManageCompanyLogo extends Component
{
    use WithFileUploads;

    public $photo;
    public $team;

    /**
     * @param $team
     * @return void
     */
    public function mount($team): void
    {
        $this->team = $team;
    }

    /**
     * TODO: Unused function
     * Checks that the image is not too big.
     * @return void
     */
    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:5120',
        ]);
    }

    /**
     * Saves the picture and adds it to the company.
     * @return void
     */
    public function save(): void
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
     * Displays the livewire logo element.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.manage-company-logo');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ManageCompanyLogo extends Component
{
    use WithFileUploads;

    public $photo;
    public $team;

    public function mount($team)
    {
        $this->team = $team;
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:5120',
        ]);
    }

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

    public function render()
    {
        return view('livewire.manage-company-logo');
    }
}

<?php

namespace App\Livewire\Company;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageLogo extends Component
{
    use WithFileUploads;

    public $photo;
    public $company;

    /**
     * Triggered when initializing the component
     * @param $company
     * @return void
     */
    public function mount($company)
    {
        $this->company = $company;
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

        $this->company->update(['logo_path' => $path]);

        //ImageOptimizer::optimize('storage/' . $path);

        $this->reset(['photo']);
        session()->flash('message', 'Logo successfully updated.');
    }

    public function render()
    {
        return view('livewire.company.manage-logo');
    }
}

<?php

namespace App\Livewire\Company;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageLogo extends Component
{
    use WithFileUploads;

    #[Validate('image|max:5120')]
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
        $this->validate();
    }

    /**
     * Saves the photo uploaded by the company
     * @return void
     */
    public function save()
    {
        $this->validate();

        $path = $this->photo->store('logos', 'public');

        $this->company->update(['logo_path' => $path]);

        //ImageOptimizer::optimize('storage/' . $path);

        $this->reset(['photo']);
        session()->flash('message', 'Logo successfully updated.');
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.company.manage-logo');
    }
}

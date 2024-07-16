<?php

namespace App\Livewire\Company;

use App\Traits\FileValidation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageLogo extends Component
{
    use WithFileUploads;
    use FileValidation;

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
     */
    public function updatedPhoto()
    {
        $this->validateFileNameLength($this->photo, 'photo');

        $this->validate([
            'photo' => [
                'image',
                'max:10240',
            ]
        ], [
            'file.max' => 'The file must not be larger than 10MB',
        ]);
    }

    /**
     * Saves the photo uploaded by the company
     * @return void
     */
    public function save()
    {
        $this->validateFileNameLength($this->photo, 'photo');

        $this->validate([
            'photo' => [
                'image',
                'max:10240',
            ]
        ], [
            'file.max' => 'The file must not be larger than 10MB',
        ]);

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
    public function render(): View
    {
        return view('livewire.company.manage-logo');
    }
}

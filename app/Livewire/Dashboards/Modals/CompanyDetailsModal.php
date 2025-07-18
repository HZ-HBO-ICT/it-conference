<?php

namespace App\Livewire\Dashboards\Modals;

use App\Livewire\Forms\CompanyForm;
use App\Models\Company;
use App\Traits\FileValidation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class CompanyDetailsModal extends ModalComponent
{
    use WithFileUploads;
    use FileValidation;

    public Company $company;
    public CompanyForm $form;
    public TemporaryUploadedFile|null $photo = null;

    /**
     * Triggered on initializing of the component
     * @param Company $company
     * @return void
     */
    public function mount(Company $company)
    {
        $this->company = $company;
        $this->form->setCompany($company);
    }

    /**
     * Updates the company details
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function save() : void
    {
        $this->authorize('update', $this->company);

        if ($this->photo) {
            $this->validateFileNameLength($this->photo, 'photo');

            $this->validate([
                'photo' => [
                    'image:allow_svg',
                    'max:10240',
                ]
            ], [
                'file.max' => 'The file must not be larger than 10MB',
            ]);

            // $this->photo is checked so that larastan doesn't complain; at this point it is not null
            if ($this->photo && $this->photo->getMimeType() === 'image/svg+xml' &&
                strtolower($this->photo->getClientOriginalExtension()) === 'svg'
            ) {
                if ($this->hasSuspiciousContent($this->photo)) {
                    Toaster::error('The file contains content that we cannot store. Please upload another file.');
                    $this->addError('photo', 'Please upload another file.');
                    return;
                }
            }

            /** @phpstan-ignore-next-line */
            $path = $this->photo->store('logos', 'public');
            $this->company->update(['logo_path' => $path]);
            $this->photo = null;
        }

        $this->validate();

        $this->form->update();
        Toaster::success('Company details were saved successfully!');
    }

    /**
     * Resets all things that could be updated in the form
     * @return void
     */
    public function cancel()
    {
        $this->form->setCompany($this->company);
        $this->photo = null;
        $this->closeModal();
    }

    /**
     * Validates the uploaded picture before showing the preview
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatedPhoto()
    {
        if ($this->photo) {
            $this->validateFileNameLength($this->photo, 'photo');

            $this->validate([
                'photo' => [
                    'image:allow_svg',
                    'max:10240',
                ]
            ], [
                'file.max' => 'The file must not be larger than 10MB',
            ]);
        }
    }

    /**
     * The maximum width of the modal
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    /**
     * Return the view for the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.modals.company-details-modal');
    }
}

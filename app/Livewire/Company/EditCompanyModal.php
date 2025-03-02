<?php

namespace App\Livewire\Company;

use App\Jobs\NotifyCompanyRoles;
use App\Livewire\Forms\CompanyForm;
use App\Mail\CompanyUpdatedMailable;
use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditCompanyModal extends ModalComponent
{
    public Company $company;
    public CompanyForm $form;

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
     * Saves the updates made on the company as redirects
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function save()
    {
        $this->authorize('update', $this->company);

        $this->validate();

        $this->form->update();

        if (Auth::user()->id == $this->company->representative->id) {
            if (!$this->company->isSameCompany($this->form->company)) {
                NotifyCompanyRoles::dispatch('crew', $this->company, CompanyUpdatedMailable::class);
            }

            return redirect(route('company.details'))
                ->with('status', 'Company successfully updated.');
        } else {
            if (!$this->company->isSameCompany($this->form->company)) {
                NotifyCompanyRoles::dispatch('company representative', $this->company, CompanyUpdatedMailable::class);
            }

            return redirect(route('moderator.companies.show', $this->company))
                ->with('status', 'Company successfully updated.');
        }
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.company.edit-company-modal');
    }
}

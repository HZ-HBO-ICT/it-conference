<?php

namespace App\View\Components\Company;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompanyLogosManager extends Component
{
    public Company $company;

    /**
     * Create a new component instance.
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.company.company-logos-manager');
    }
}

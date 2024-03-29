<?php

namespace Database\Seeders;

use App\Models\Booth;
use App\Models\Company;
use App\Models\Presentation;
use App\Models\User;
use App\Models\UserPresentation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::factory(5)
            ->has(Booth::factory(1))
            ->has(User::factory(3))
            ->create();
        $this->setPresentation($companies);

        $company = Company::factory()->hasSponsorship('gold')
            ->has(User::factory(2))
            ->create();

        foreach ($company->users as $user) {
            $presentation = Presentation::factory()->create();
            $presentation->company_id = $company->id;
            $presentation->save();
            $user->joinPresentation($presentation, 'speaker');
        }

        $companies = Company::factory(3)->hasSponsorship('silver')
            ->has(User::factory(3))->create();
        $this->setPresentation($companies);

        $companies = Company::factory(5)->hasSponsorship('bronze')
            ->has(User::factory(3))->create();
        $this->setPresentation($companies);
    }

    /**
     * Sets one presentation per each of the companies passed
     * @param $companies
     * @return void
     */
    private function setPresentation($companies) {
        foreach ($companies as $company) {
            $presentation = Presentation::factory()->create();
            $presentation->company_id = $company->id;
            $presentation->save();

            foreach ($company->users as $user) {
                $user->joinPresentation($presentation, 'speaker');
            }
        }
    }
}

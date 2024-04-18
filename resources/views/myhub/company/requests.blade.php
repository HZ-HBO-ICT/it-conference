@php use Illuminate\Support\Facades\Auth; @endphp
<x-hub-layout>
    <div class="sm:px-6 lg:px-8">
        <div class="pt-7">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{$company->name}} requests
            </h2>
            <h2 class="text-md text-gray-800 dark:text-gray-200 leading-tight pt-3">
                Here you can request to become a sponsor or request to have a booth
            </h2>
        </div>
        <div class="max-w-7xl mx-auto py-10">
            @if($company->is_approved)
                @livewire('company.booth-request', ['company' => $company])
                <x-section-border/>
                @livewire('company.sponsorship-request', ['company' => $company])
            @else
                <p class="text-md text-gray-900 dark:text-gray-200">
                    You currently cannot request a booth or sponsorship since your company is waiting for approval.
                    <span class="mt-0.5 block">
                    You will be notified as soon as your company is approved, and you will be able to send requests.
                        </span>
                </p>

                <div class="pt-5">
                    <a href="{{ url()->previous()}}"
                       class="bg-purple-800 text-white py-2 px-4 rounded text-center transition-all duration-300 transform hover:scale-105">
                        Go back
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-hub-layout>

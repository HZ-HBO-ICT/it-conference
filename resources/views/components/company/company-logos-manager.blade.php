<x-action-section>
    <x-slot name="title">
        {{ __('Company logo') }}
    </x-slot>

    <x-slot name="description">
        {{ __("Add the logo of your company. Due to the fact that we utilize dark mode as well,
        we suggest that you upload a dark theme of your logo as well. We also suggest that you upload a
        transparent background image for the logo. If you don't upload one a placeholder will be used") }}
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-2 gap-2">
            @livewire('company.manage-logo', ['company' => $company ], key('light'))
            @livewire('company.manage-logo', ['company' => $company, 'theme' => 'dark' ], key('dark'))
        </div>
    </x-slot>
</x-action-section>

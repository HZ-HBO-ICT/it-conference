<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </div>

    <div class="pt-5">
        <livewire:users.user-filtering-list :role="$role"/>
    </div>
</x-crew-colorful-layout>

<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
        <div class="pt-5 ">
            <livewire:users.user-filtering-list :role="$role"/>
        </div>
    </div>
</x-hub-layout>

@php use Carbon\Carbon; @endphp
<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedule management') }}</h1>
        <livewire:schedule.grid-parent-component/>
    </div>
</x-hub-layout>

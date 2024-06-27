@php
    use Carbon\Carbon;
    use App\Models\DefaultPresentation;
@endphp
<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedule management') }}</h1>
        @if(is_null(DefaultPresentation::opening()) || is_null(DefaultPresentation::closing()))
            <x-schedule.set-default-presentations/>
        @else
            <livewire:schedule.grid-parent-component/>
        @endif
    </div>
</x-hub-layout>

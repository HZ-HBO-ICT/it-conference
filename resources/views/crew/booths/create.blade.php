@php use App\Models\Company; @endphp
<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Create a booth') }}
        </h2>
    </div>
    <div class="py-5">
        <livewire:booth.create-booth/>
    </div>
</x-crew-colorful-layout>

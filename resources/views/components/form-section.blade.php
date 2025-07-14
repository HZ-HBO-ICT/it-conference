@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6 text-white']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="px-8 py-8 bg-white/10 backdrop-blur-md rounded-2xl shadow-lg">
                {{ $form }}
                @if (isset($actions))
                    <div class="flex items-center justify-end pt-8 text-right">
                        {{ $actions }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>

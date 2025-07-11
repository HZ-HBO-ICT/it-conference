@props(['formAction' => false])

<div class="bg-gray-900 rounded shadow-2xl overflow-hidden w-full mx-auto">
    @if($formAction)
        <form wire:submit.prevent="{{ $formAction }}">
            @endif

            {{-- Title --}}
            @if(isset($title))
                <div class="flex items-start justify-between px-6 pt-6 pb-2">
                    <h3 class="text-xl font-semibold text-white">
                        {{ $title }}
                    </h3>

                    <button type="button" tabindex="-1"
                            wire:click="$dispatch('closeModal')"
                            class="text-gray-300 hover:text-white transition duration-200 text-xl font-bold leading-none flex items-center justify-center hover:cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                    </button>
                </div>
            @endif

            {{-- Content --}}
            @if(isset($content))
                <div {{ $content->attributes->class(['px-6 py-4']) }}>
                    <div class="space-y-6">
                        {{ $content }}
                    </div>
                </div>
            @endif

            {{-- Buttons --}}
            @if(isset($buttons))
                <div {{ $buttons->attributes->class(['px-6 pb-6 pt-2 flex justify-end gap-3']) }}>
                    {{ $buttons }}
                </div>
            @endif

            @if($formAction)
        </form>
    @endif
</div>

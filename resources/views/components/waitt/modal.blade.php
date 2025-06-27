@props(['formAction' => false])

<div class="bg-gray-900 rounded shadow-2xl overflow-hidden w-full mx-auto">
    @if($formAction)
        <form wire:submit.prevent="{{ $formAction }}">
            @endif

            {{-- Title --}}
            @if(isset($title))
                <div {{ $title->attributes->class(['text-xl px-6 pt-6 pb-2']) }}>
                    <h3 class="font-semibold text-white">
                        {{ $title }}
                    </h3>
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

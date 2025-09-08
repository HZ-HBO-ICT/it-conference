@props(['formAction' => false])

<div class="z-50">
    @if($formAction)
        <form wire:submit.prevent="{{ $formAction }}">
            @endif

            @if(isset($title))
                <div {{ $title->attributes->class(['bg-waitt-dark p-4 sm:px-6 sm:py-4 border-b border-slate-900']) }}>
                    <h3 class="text-lg leading-6 font-medium text-white">
                        {{ $title }}
                    </h3>
                </div>
            @endif

            @if(isset($content))
                <div {{ $content->attributes->class(['bg-waitt-dark px-4 sm:p-6']) }}>
                    <div class="space-y-6">
                        {{ $content }}
                    </div>
                </div>
            @endif

            @if(isset($buttons))
                <div {{ $buttons->attributes->class(['bg-waitt-dark border-t border-slate-900 px-4 py-5 sm:px-4 sm:flex sm:items-end sm:justify-end']) }}>
                    {{ $buttons }}
                </div>

            @endif

            @if($formAction)
        </form>
    @endif
</div>

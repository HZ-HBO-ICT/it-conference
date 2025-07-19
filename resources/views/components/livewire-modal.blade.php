@props(['formAction' => false])

<div>
    @if($formAction)
        <form wire:submit.prevent="{{ $formAction }}">
    @endif

    @if(isset($title))
        <div {{ $title->attributes->class(['bg-waitt-dark p-4 sm:px-6 sm:py-4 border-b border-gray-600']) }}>
            {{ $title }}
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
        <div {{ $buttons->attributes->class(['bg-waitt-dark px-4 py-5 sm:px-4 sm:flex sm:items-end sm:justify-end']) }}>
            {{ $buttons }}
        </div>
    @endif

    @if($formAction)
        </form>
    @endif
</div>

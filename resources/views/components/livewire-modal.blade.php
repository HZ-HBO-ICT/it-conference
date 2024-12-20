@props(['formAction' => false])

<div>
    @if($formAction)
        <form wire:submit.prevent="{{ $formAction }}">
            @endif

            @if(isset($title))
                <div {{ $title->attributes->class(['bg-white dark:bg-gray-900 p-4 sm:px-6 sm:py-4 border-b border-gray-150 dark:border-gray-800']) }}>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                        {{ $title }}
                    </h3>
                </div>
            @endif

            @if(isset($content))
                <div {{ $content->attributes->class(['bg-white dark:bg-gray-900 px-4 sm:p-6']) }}>
                    <div class="space-y-6">
                        {{ $content }}
                    </div>
                </div>
            @endif

            @if(isset($buttons))
                <div {{ $buttons->attributes->class(['bg-gray-100 dark:bg-gray-900 px-4 py-5 sm:px-4 sm:flex sm:items-end sm:justify-end']) }}>
                    {{ $buttons }}
                </div>

            @endif

            @if($formAction)
        </form>
    @endif
</div>

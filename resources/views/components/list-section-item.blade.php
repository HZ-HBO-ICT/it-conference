<li {!! $attributes->merge([ 'class' => 'm-3 p-3 sm:rounded-md hover:bg-crew-200 dark:hover:bg-slate-700']) !!}>
    @if ($attributes->has('url'))
        <a href="{{ $url }}">
            {{ $slot }}
        </a>
    @else
        {{ $slot }}
    @endif
</li>

<li {!! $attributes->merge([ 'class' => 'm-3 p-3 sm:rounded-md hover:bg-crew-100 dark:hover:bg-slate-600']) !!}>
    @if ($attributes->has('url'))
        <a href="{{ $url }}">
            {{ $slot }}
        </a>
    @else
        {{ $slot }}
    @endif
</li>

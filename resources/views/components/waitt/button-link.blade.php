<a {{ $attributes->merge(['href' => '#', 'class' => 'inline-flex items-center px-4 py-2 bg-waitt-dark border border-waitt-yellow rounded-md font-semibold text-xs text-waitt-yellow hover:border-waitt-pink hover:text-waitt-pink transition-all uppercase tracking-widest focus:outline-hidden ease-in-out duration-150']) }}>
    {{ $slot }}
</a>

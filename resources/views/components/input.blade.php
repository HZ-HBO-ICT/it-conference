@props(['disabled' => false])

<input {{ $attributes->merge([
    'class' => 'block w-full rounded-md bg-white/10 backdrop-blur-md text-white border border-white/20 focus:border-waitt-yellow focus:ring-waitt-yellow placeholder-gray-300',
]) }}>

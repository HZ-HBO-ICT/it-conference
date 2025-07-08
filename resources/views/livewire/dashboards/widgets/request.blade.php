<div class="relative w-full h-full min-h-48 rounded rounded-lg hover:cursor-pointer text-white {{ $class ?? 'bg-black/[var(--bg-opacity)] [--bg-opacity:60%]' }}"
     onclick="Livewire.dispatch('openModal', { component: 'dashboards.modals.request-{{lcfirst($type)}}-modal', arguments: { company: {{$company}} } })">
    <div class="pt-5 px-5">
        <h3 class="text-lg font-semibold">{{$type}}</h3>
        <p class="text-xs">{{ $description }}</p>
    </div>
    <p class="absolute bottom-5 left-5 text-xs text-gray-500 flex items-center">
        Request {{ lcfirst($type) }}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ml-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
        </svg>
    </p>
</div>

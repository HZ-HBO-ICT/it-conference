@php use Illuminate\Support\Facades\Auth; @endphp

<div
    x-data="{ shine: false }"
    x-init="setInterval(() => shine = !shine, 2500)"
    :class="{ 'shine-effect-auto': shine }"
    class="mb-5 relative bg-waitt-dark/80 backdrop-blur-md border border-waitt-yellow/30 text-white rounded-xl px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-6 overflow-hidden"
    style="--shine-color: rgba(255, 230, 0, 0.08);"
>
    <div class="relative inline-flex items-center justify-center text-xs font-bold uppercase px-3 py-1 rounded-full bg-waitt-yellow text-black">
        Booth
    </div>
    <div class="flex-1 text-sm leading-relaxed text-white">
        <span class="font-semibold">Booth Owner Invitation</span> —
        You're listed as a booth owner for <strong>{{ Auth::user()->company->name }}</strong> at the <b>WAITT25</b> conference.
    </div>
    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
        @foreach($boothButtons as $label => $joinBooth)
            @if ($loop->last && count($boothButtons) > 1)
                <span class="text-xs text-gray-400 text-center">or</span>
            @endif

                <button
                    onclick="Livewire.dispatch('openModal', { component: 'dashboards.modals.request-booth-modal', arguments: { company: {{Auth::user()->company}}, user: {{Auth::user()}}, joinBoothOwners: {{json_encode($joinBooth)}} } })"
                    class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium bg-waitt-yellow hover:bg-waitt-yellow-500 hover:cursor-pointer text-black transition whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    {{ $label }}
                </button>
        @endforeach
    </div>
</div>

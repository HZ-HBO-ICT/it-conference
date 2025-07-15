@php use Illuminate\Support\Facades\Auth; @endphp

<div
    x-data="{ shine: false }"
    x-init="setInterval(() => shine = !shine, 2500)"
    :class="{ 'shine-effect-auto': shine }"
    class="mb-5 relative bg-waitt-dark/80 backdrop-blur-md border border-waitt-cyan-500/30 text-white rounded-xl px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-6 overflow-hidden"
    style="--shine-color: rgba(59,255,219,0.1)"
>
    <div class="relative inline-flex items-center justify-center text-xs font-bold uppercase px-3 py-1 rounded-full bg-waitt-cyan-600 text-white">
        Important
    </div>

    <div class="flex-1 text-sm leading-relaxed text-white">
        <span class="font-semibold">Speaker Invitation</span> —
        You’ve been invited by <strong>{{ Auth::user()->company->representative->name }}</strong> to become a speaker in
        the <b>WAITT25</b> conference within {{ Auth::user()->company->name }}.
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
            <a onclick="Livewire.dispatch('openModal', { component: 'dashboards.modals.create-edit-presentation-modal', arguments: { user: {{ Auth::user() }}, presentationId: {{ 'null' }} } })"
               class="inline-flex text-wrap items-center px-4 py-2 rounded-md text-sm font-medium bg-waitt-cyan-600 hover:bg-waitt-cyan-700 hover:cursor-pointer text-white transition whitespace-nowrap">
                Request a presentation
            </a>
        <span class="text-xs text-gray-400 text-center">or join as co-speaker below</span>
    </div>
</div>

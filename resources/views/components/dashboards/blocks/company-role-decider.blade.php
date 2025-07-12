@php use Illuminate\Support\Facades\Auth; @endphp

<div
    x-data="{ shine: false }"
    x-init="setInterval(() => shine = !shine, 2500)"
    :class="{ 'shine-effect-auto': shine }"
    class="mb-5 relative bg-waitt-dark/80 backdrop-blur-md border border-white text-white rounded-xl px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-6 overflow-hidden"
>
    <div
        class="inline-flex items-center text-xs font-bold uppercase px-3 py-1 rounded-full bg-white text-black">
        Important
    </div>

    <div class="flex-1 text-sm leading-snug text-white">
        You're part of <strong>{{ Auth::user()->company->name }}</strong> for <b>WAITT25</b>. Choose how you want to
        represent them.
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
        @foreach($speakerButtons as $label => $item)
            <a onclick="Livewire.dispatch('openModal', { component: 'dashboards.modals.create-edit-presentation-modal', arguments: { user: {{ Auth::user() }}, presentationId: {{ $item ? $item->id : 'null' }}, joinAsSpeaker: {{ Auth::user()->can('joinAsCospeaker', $item) }} } })"
               class="inline-flex text-wrap items-center px-4 py-2 rounded-md text-sm font-medium bg-waitt-pink hover:bg-waitt-pink-600 hover:cursor-pointer text-black transition whitespace-nowrap">
                {{ $label }}
            </a>
        @endforeach

        @foreach($boothButtons as $label => $joinBooth)
            <button
                onclick="Livewire.dispatch('openModal', { component: 'dashboards.modals.request-booth-modal', arguments: { company: {{Auth::user()->company}}, user: {{Auth::user()}}, joinBoothOwners: {{json_encode($joinBooth)}} } })"
                class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium bg-waitt-yellow hover:bg-waitt-yellow-600 hover:cursor-pointer text-black transition whitespace-nowrap">
                {{ $label }}
            </button>
        @endforeach
    </div>
</div>

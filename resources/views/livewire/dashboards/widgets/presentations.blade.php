@php use App\Models\Presentation;use Illuminate\Support\Facades\Auth; @endphp
<div class="bg-black/[var(--bg-opacity)] [--bg-opacity:60%] w-full h-full rounded rounded-lg text-white">
    <div class="font-semibold text-sm p-5">
        <p class="text-md md:text-lg">Presentations</p>
        <div class="grid grid-col-1 w-full pt-5">
            @forelse($presentations as $presentation)
                <div>
                    <div
                        class="relative bg-gradient-to-br from-gray-800 to-gray-900 text-white px-6 py-3 rounded-xl overflow-hidden">
                        <!-- Slanted overlay -->
                        <div class="absolute -right-5 top-0 h-full w-20 bg-silver/40 skew-x-12"></div>
                        <div class="absolute top-1 right-3 z-10 text-white text-lg"
                             onclick="Livewire.dispatch('openModal', { component: 'dashboards.modals.create-edit-presentation-modal', arguments: {user: {{Auth::user()}}, presentationId: {{$presentation->id}} }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6 hover:cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <p class="uppercase text-xs opacity-70">{{ $presentation->type }}</p>
                            <h2 class=" font-bold">{{ $presentation->name  }}</h2>
                            <x-waitt.approval-status :status="$presentation->approval_status" />
                        </div>
                    </div>

                    <div class="mt-5 font-light text-xs">
                        Do you want more presentations? <a href='{{route('contact')}}' class="text-waitt-pink hover:cursor-pointer underline">Let us know!</a>
                    </div>
                </div>
            @empty
                <div class="font-normal">
                    You have no presentations.
                    @can('request', Presentation::class)
                        <span class="underline transition-colors hover:text-waitt-pink hover:cursor-pointer"
                            onclick="Livewire.dispatch('openModal', { component: 'dashboards.modals.create-edit-presentation-modal', arguments: {user: {{Auth::user()}}, presentationId: null } })">
                             Request one!
                         </span>
                    @endcan
                </div>
            @endforelse
        </div>
    </div>
</div>

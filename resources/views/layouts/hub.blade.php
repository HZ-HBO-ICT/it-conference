@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Presentation;
@endphp

<x-app-layout>
    <div class="flex">
        <div class="flex-col w-72 flex z-50 inset-y-0 relative bg-white dark:bg-gray-900 h-screen">
            <div
                class="pb-4 px-6 border-r border-b border-t dark:border-gray-800 overflow-y-auto gap-y-5 flex-col flex-grow flex">
                <div class="items-center flex-shrink-0 h-16 flex mt-4">
                    <!-- TODO: Style heading -->
                    <h3 class="font-semibold dark:text-white">My hub</h3>
                </div>
                @if(Auth::user()->hasRole('content moderator'))
                    <x-sidemenus.content-moderator-sidemenu/>
                @elseif(Auth::user()->currentTeam)
                    <x-sidemenus.company-sidemenu/>
                @elseif(!Auth::user()->hasRole('content moderator'))
                    <x-sidemenus.participant-sidemenu/>
                @endif
            </div>
        </div>
        <!-- Content -->
        <div class="flex-grow max-h-screen overflow-y-auto bg-gray-100 dark:bg-gray-900">
            {{ $slot }}
        </div>
    </div>
</x-app-layout>

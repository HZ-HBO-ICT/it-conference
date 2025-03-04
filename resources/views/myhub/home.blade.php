@php
    use App\Models\Team;
    use App\Models\Booth;
    use App\Models\Speaker;
    use App\Models\User;use Illuminate\Support\Facades\Auth;
@endphp

<x-hub-layout>
    <div>
        <div class="py-8 px-8 mx-auto max-w-7xl">
            <div>
                <h3 class="leading-6 font-semibold text-xl dark:text-white">Dashboard</h3>
                @if(Auth::user()->company)
                    <x-dashboards.company/>
                @endif
                @if(Auth::user()->is_crew)
                    <x-dashboards.crew/>
                @else
                    <div class="px-6">
                        <x-dashboards.blocks.participant-notification>
                            <h4 class="text-lg font-semibold mb-2">New! 🌟 Submit Your Feedback</h4>
                            <p>We are eager to hear from you! Run into any issues, have ideas, or just want to tell us
                               what's working well? We're all ears. Hit the button below to let us know what you think!</p>
                            <a href="{{ route('feedback.create') }}"
                               class="mt-4 inline-block px-6 py-3 bg-white text-gray-800 font-semibold rounded-full shadow-sm hover:bg-gray-100 transition duration-150 ease-in-out">
                                Go to Feedback Form
                            </a>
                        </x-dashboards.blocks.participant-notification>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-hub-layout>

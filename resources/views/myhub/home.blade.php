@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

@if($user->is_crew && $user->company)
    <!-- Special case for the event organizer + company rep -->
    @if(session('showCompanyView'))
        <x-spa-layout>
            <div class="min-h-screen bg-waitt-dark">
                <div class="py-4 px-4 mx-auto max-w-7xl">
                    <div
                        class="absolute top-1/2 left-1/10 w-sm h-[24rem] bg-[#31F7F1] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                    <div
                        class="absolute top-2/3 left-4/7 w-sm h-[24rem] bg-[#E2FF32] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                    <div
                        class="absolute top-1/5 left-3/7 w-sm h-[24rem] bg-[#FF3B9A] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                    <div class="relative z-5 py-2 md:py-5 px-0 md:px-3 mx-auto max-w-8xl">
                        <div>
                            <livewire:dashboards.company/>
                        </div>
                    </div>
                </div>
            </div>
        </x-spa-layout>
    @else
        <x-crew-layout>
            <div class="min-h-screen bg-waitt-dark">
                <div class="py-4 md:py-8 px-4 md:px-8 mx-auto max-w-7xl">
                    <div
                        class="absolute top-1/2 left-1/10 w-sm h-[24rem] bg-[#31F7F1] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                    <div
                        class="absolute top-2/3 left-4/7 w-sm h-[24rem] bg-[#E2FF32] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                    <div
                        class="absolute top-1/5 left-3/7 w-sm h-[24rem] bg-[#FF3B9A] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                    <div class="relative z-5 py-2 md:py-5 px-0 md:px-3 mx-auto max-w-8xl">
                        <div>
                            <h3 class="leading-6 font-semibold text-xl dark:text-white">Dashboard</h3>
                            <x-dashboards.crew/>
                        </div>
                    </div>
                </div>
            </div>
        </x-crew-layout>
    @endif
@elseif($user->company)
    <x-spa-layout>
        <div class="min-h-screen bg-waitt-dark">
            <div class="py-4 px-4 mx-auto max-w-7xl">
                <div
                    class="absolute top-1/2 left-1/10 w-sm h-[24rem] bg-[#31F7F1] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                <div
                    class="absolute top-2/3 left-4/7 w-sm h-[24rem] bg-[#E2FF32] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                <div
                    class="absolute top-1/5 left-3/7 w-sm h-[24rem] bg-[#FF3B9A] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                <div class="relative z-5 py-2 md:py-5 px-0 md:px-3 mx-auto max-w-8xl">
                    <div>
                        <livewire:dashboards.company/>
                    </div>
                </div>
            </div>
        </div>
    </x-spa-layout>
@elseif($user->is_crew)
    <x-crew-layout>
        <div class="min-h-screen bg-waitt-dark">
            <div class="py-4 md:py-8 px-4 md:px-8 mx-auto max-w-7xl">
                <div
                    class="absolute top-1/2 left-1/10 w-sm h-[24rem] bg-[#31F7F1] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                <div
                    class="absolute top-2/3 left-4/7 w-sm h-[24rem] bg-[#E2FF32] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                <div
                    class="absolute top-1/5 left-3/7 w-sm h-[24rem] bg-[#FF3B9A] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
                <div class="relative z-5 py-2 md:py-5 px-0 md:px-3 mx-auto max-w-8xl">
                    <div>
                        <h3 class="leading-6 font-semibold text-xl dark:text-white">Dashboard</h3>
                        <x-dashboards.crew/>
                    </div>
                </div>
            </div>
        </div>
    </x-crew-layout>
@else
    <x-hub-layout>
        <div>
            <div class="py-8 px-8 mx-auto max-w-7xl">
                <div>
                    <h3 class="leading-6 font-semibold text-xl dark:text-white">Dashboard</h3>
                    <div class="px-6">
                        <x-dashboards.blocks.participant-notification>
                            <h4 class="text-lg font-semibold mb-2">New! 🌟 Submit Your Feedback</h4>
                            <p>We are eager to hear from you! Run into any issues, have ideas, or just want to tell
                                us
                                what's working well? We're all ears. Hit the button below to let us know what you
                                think!</p>
                            <a href="{{ route('feedback.create') }}"
                               class="mt-4 inline-block px-6 py-3 bg-white text-gray-800 font-semibold rounded-full shadow-sm hover:bg-gray-100 transition duration-150 ease-in-out">
                                Go to Feedback Form
                            </a>
                        </x-dashboards.blocks.participant-notification>
                    </div>
                </div>
            </div>
        </div>
    </x-hub-layout>
@endif

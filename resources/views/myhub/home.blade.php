@php
    use App\Models\Team;
    use App\Models\Booth;
    use App\Models\Speaker;
    use App\Models\User;use Illuminate\Support\Facades\Auth;
@endphp

<x-spa-layout>
    <div class="min-h-screen bg-[#070E1C]">
        <div class="py-8 px-8 mx-auto max-w-7xl">
            <div class="absolute top-1/2 left-1/10 w-sm h-[24rem] bg-[#31F7F1] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
            <div class="absolute top-2/3 left-4/7 w-sm h-[24rem] bg-[#E2FF32] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
            <div class="absolute top-1/5 left-3/7 w-sm h-[24rem] bg-[#FF3B9A] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>

            <!-- Content -->
            <div class="relative z-5 py-8 px-3 mx-auto max-w-8xl">
                <div>
                    @if(Auth::user()->company)
                        <livewire:dashboards.company/>
                    @endif
                    @if(Auth::user()->is_crew)
                        <x-dashboards.crew/>
                    @else

                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
</x-spa-layout>

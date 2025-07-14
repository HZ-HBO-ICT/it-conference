@php
    use Illuminate\Support\Facades\Auth;
@endphp
<x-hub-layout>
    <div class="relative min-h-screen w-full bg-waitt-dark overflow-hidden">
        <!-- Decorative Blobs -->
        <div class="absolute top-1/2 left-1/10 w-sm h-[24rem] bg-[#31F7F1] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
        <div class="absolute top-2/3 left-4/7 w-sm h-[24rem] bg-[#E2FF32] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
        <div class="absolute top-1/5 left-3/7 w-sm h-[24rem] bg-[#FF3B9A] rounded-full filter blur-3xl opacity-60 mix-blend-screen z-0"></div>
        <!-- Main Content -->
        <div class="relative z-10 py-8 px-8 mx-auto max-w-7xl">
            <h2 class="font-semibold text-2xl text-gray-200 leading-tight">
                Profile
            </h2>
            <div class="pt-5">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('profile.update-profile-information-form')
                    <x-section-border/>
                @endif
                @if(Auth::user()->ticket && !Auth::user()->is_crew && optional(\App\Models\Edition::current())->is_final_programme_released)
                    <livewire:qr-code.ticket />
                    <x-section-border />
                @endif
                @livewire('email-notification-preference')
                <x-section-border/>
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.update-password-form')
                    </div>
                    <x-section-border/>
                @endif
                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.two-factor-authentication-form')
                    </div>
                    <x-section-border/>
                @endif
                {{--@if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())--}}
                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.delete-user-form')
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-hub-layout>

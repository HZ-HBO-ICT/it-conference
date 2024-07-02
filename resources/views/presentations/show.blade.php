@php
    use Carbon\Carbon;
    use App\Models\User;
@endphp
@php
    use Illuminate\Support\Facades\Auth;
@endphp
<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My presentation') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Presentation information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The detail information about your presentation.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation title</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{$presentation->name}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation
                                                                                                description
                        </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{$presentation-> description}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation type</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{ucfirst($presentation->type)}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Difficulty level</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{ucfirst($presentation->difficulty->level)}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Suggested max
                                                                                                participants
                        </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{$presentation->max_participants}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Presentation status</dt>
                        <dd class="mt-1 text-sm leading-6 {{$presentation->is_approved ? "text-green-500" : "text-yellow-500"}} sm:col-span-2 sm:mt-0">
                            {{$presentation->is_approved ? 'Approved' : 'Awaiting approval'}}
                        </dd>
                    </div>
                    @can('update', $presentation)
                        <div class="mt-5">
                            <x-button onclick="Livewire.dispatch('openModal', { component: 'presentation.edit-presentation-modal', arguments: {presentation: {{$presentation}}} })">
                                {{ __('Edit') }}
                            </x-button>
                        </div>
                    @endcan
                </x-slot>

            </x-action-section>

            <x-section-border/>

            @if(Auth::user()->isPresenterOf($presentation))
                @livewire('presentation.upload-presentation', ['presentation' => $presentation])
            @elseif(Auth::user()->isDefaultCompanyMember)
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Presentation information') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('The detail information about your presentation.') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="dark:text-gray-200">
                            Since you still don't have a specific role within the company, if you'd like to be a
                            co-speaker of this presentation, join here.
                        </div>
                    </x-slot>

                    <x-slot name="actions">
                        <x-button class="bg-partner-700 hover:bg-partner-800"
                            onclick="Livewire.dispatch('openModal', { component: 'presentation.join-as-speaker-modal', arguments: {presentation: {{$presentation}}} })">
                            {{ __('Join presentation as co-speaker') }}
                        </x-button>
                    </x-slot>
                </x-action-section>
            @endif

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Participants') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('List of people who signed up for the presentation.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <ul>
                            @forelse($presentation->participants as $participant)
                                <li class="py-2">{{$participant->name}} ({{$participant->email}})</li>
                            @empty
                                <li>There are no participants that have registered just yet.</li>
                            @endforelse
                        </ul>
                    </div>
                </x-slot>

            </x-action-section>

            <x-section-border/>

            @can('delete', $presentation)
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Delete This Presentation') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Permanently remove the presentation from the system') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="dark:text-gray-200">
                            @if(Auth::user()->hasRole('content moderator'))
                                {{ __('If you delete this presentation, the speaker/s will no longer have this presentation, it will be gone
                                from the schedule and all participants that have registered for it will be dis-enrolled from it') }}
                            @else
                                {{ __('Your presentation is still not approved and you can still remove your presentation') }}
                            @endif
                        </div>
                    </x-slot>

                    <x-slot name="actions">
                        <x-danger-button
                            onclick="Livewire.dispatch('openModal', { component: 'presentation.delete-presentation-modal', arguments: {presentation: {{$presentation}}} })">
                            {{ __('Delete Presentation') }}
                        </x-danger-button>
                    </x-slot>

                </x-action-section>
            @else
                <x-action-section>

                    <x-slot name="title">
                        {{ __('Delete Presentation') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Permanently delete your presentation.') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                            If you wish to not be present during the conference contact us at <a
                                href="mailto:info@weareinittogether.nl" class="text-purple-500">info@weareinittogether.nl</a>
                        </div>
                    </x-slot>
                </x-action-section>
            @endcan
        </div>
    </div>
</x-hub-layout>

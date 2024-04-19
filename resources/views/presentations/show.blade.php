@php
    use Carbon\Carbon;
    use App\Models\EventInstance;
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
                        <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{$presentation->type}}</dd>
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
{{--
                            @livewire('presentations.edit-presentation-modal', ['presentation' => $presentation])
--}}
                        </div>
                    @endcan
                </x-slot>

            </x-action-section>

            <x-section-border/>

{{--
            @livewire('upload-presentation', ['presentation' => $presentation])
--}}

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
                {{--<div class="mt-10 sm:mt-0">
                    @livewire('presentations.delete-presentation-form', ['presentation' => $presentation])
                </div>--}}
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


{{--<x-hub-layout>--}}
{{--    <x-presentation-details--}}
{{--        :presentation="$presentation"--}}
{{--        :presentationName="$presentation->name"--}}
{{--        :presentationDescription="$presentation->description"--}}
{{--        :filename="basename($presentation->file_path)"--}}
{{--        :presentationType="$presentation->type"--}}
{{--        :presentationMaxParticipants="$presentation->max_participants"--}}
{{--    />--}}

@php
    use Carbon\Carbon;
    use App\Models\EventInstance;
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
                        <dt class="text-sm font-medium leading-6 text-gray-900">Presentation title</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$presentation->name}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Presentation description</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$presentation-> description}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Presentation type</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$presentation->type}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Suggested max participants</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$presentation->max_participants}}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Presentation status</dt>
                        <dd class="mt-1 text-sm leading-6 {{$presentation->mainSpeaker()->is_approved ? "text-green-500" : "text-yellow-500"}} sm:col-span-2 sm:mt-0">
                            {{$presentation->mainSpeaker()->is_approved ? 'Approved' : 'Awaiting approval'}}
                        </dd>
                    </div>
                    <div class="mt-5">
                        <x-button type="button" wire:loading.attr="disabled">
                            {{ __('Edit') }}
                        </x-button>

                    </div>
                </x-slot>

            </x-action-section>

            <x-section-border/>

            @livewire('upload-presentation', ['presentation' => $presentation])
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

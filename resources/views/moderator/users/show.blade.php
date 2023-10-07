<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User details') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Personal Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The data that the user has provided when registering') }}
                </x-slot>

                <x-slot name="content">
                    <div class="flex gap-5">
                        <div class="flex-col">
                            <img class="w-52 h-52 rounded-full mx-auto my-auto max-w-full block dark:text-white"
                                 src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"/>
                        </div>
                        <div class="flex-col flex-grow pl-2">
                            <h3>{{ $user->name }}</h3>
                            <p class="text-gray-500 text-sm">
                                {{ $user->email }}
                            </p>
                            <h3 class="pt-3">Roles</h3>
                            <p class="text-gray-500 text-sm">
                                {{implode(', ', $user->getRoleNames()->ToArray())}}
                            </p>
                            @if($user->currentTeam)
                                <h3 class="pt-3">Company</h3>
                                <p class="text-gray-500 text-sm">
                                    {{$user->currentTeam->name}}
                                </p>
                            @endif
                            @if($user->institution)
                                <h3 class="pt-3">Institution</h3>
                                <p class="text-gray-500 text-sm">
                                    {{$user->institution}}
                                </p>
                            @endif
                            @if($user->speaker)
                                <h3 class="pt-3">Presentation</h3>
                                <p class="text-gray-500 text-sm">
                                    {{$user->speaker->presentation->name}}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div>
                        {{--{{ $company->description }}--}}
                    </div>
                </x-slot>

            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Delete This User') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Permanently delete this user and all related data.') }}
                </x-slot>

                <x-slot name="content">
                    <p>
                        {{ __('If the user is main speaker of presentation, the presentation will be deleted as well.
                        If the user is company representative, the company will be deleted, all presentations inside
                        of it as well, and all people in the company will only be participants.') }}
                    </p>
                </x-slot>

                <x-slot name="actions">
                    <form method="POST" action="{{route('moderator.users.show', $user)}}">
                        @method('DELETE')
                        @csrf
                        <x-danger-button type="submit">Remove this user</x-danger-button>
                    </form>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-hub-layout>

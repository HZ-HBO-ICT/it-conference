<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company details') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Company Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The company\'s name, address and other information that is visible for all users.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="flex">
                        <div class="flex-col">
                            @if($company->logo_path)
                                <img class="w-56 h-56 mx-auto my-auto max-w-full block dark:text-white"
                                     src="{{ url('storage/'. $company->logo_path) }}" alt="Logo of {{$company->name}}">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="gray" aria-hidden="true" class="w-24 h-24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                </svg>

                            @endif
                        </div>
                        <div class="flex-col flex-grow pl-2">
                            <h3>{{ $company->name }}</h3>
                            <p class="text-gray-500 text-sm">
                                {{ $company->street }} {{ $company->house_number }} <br>
                                {{ $company->postcode }}  {{ $company->city }}
                            </p>
                        </div>
                    </div>
                    <div>
                        {{ $company->description }}
                    </div>
                </x-slot>

                <x-slot name="actions">
                    {{-- TODO create Edit page or, even better, a LiveWire component --}}
                    <x-button-link href="#">{{ __('Edit') }}</x-button-link>
                </x-slot>
            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Company Approval Status') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('When the status is Approved, the company will show up at the lineup. The company is also able to request for presentations, sponsorships and booths.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="mt-1 text-sm leading-6 text-{{ $company->is_approved ? 'green-500' : 'yellow-500' }} sm:col-span-2 sm:mt-0">
                        {{ $company->is_approved ? 'Approved' : 'Awaiting approval' }}
                    </div>
                </x-slot>

                @if(!$company->is_approved)
                    <x-slot name="actions">
                        <form method="POST" action="{{ route('moderator.companies.approve', $company) }}" class="mr-2">
                            @csrf
                            <input type="hidden" name="approved" value="1"/>
                            <x-button
                                class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                                {{ __('Approve') }}
                            </x-button>
                        </form>
                        <form method="POST" action="{{ route('moderator.companies.approve', $company) }}" class="mr-2">
                            @csrf
                            <input type="hidden" name="approved" value="0"/>
                            <x-button
                                class="dark:bg-red-500 bg-red-500 hover:bg-red-600 hover:dark:bg-red-600 active:bg-red-600 active:dark:bg-red-600">
                                {{ __('Reject') }}
                            </x-button>
                        </form>
                    </x-slot>
                @endif
            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Company Members') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The participants who are related to this company.') }}
                </x-slot>

                <x-slot name="content">
                    @forelse($company->users as $user)
                        {{-- TODO render users properly when I know how roles function --}}
                        {{ $user->name }} | {{ $user->role }}
                    @empty
                        {{ __('There are currently no users in this company') }}
                    @endforelse
                    <p>
                        TODO: connect existing users to this company (app might suggest based on email domain name
                        that equals the company rep's domain
                        TODO: invite users
                        TODO: remove users from team
                    </p>
                </x-slot>
            </x-action-section>

            <x-section-border/>

            <x-action-section>
                <x-slot name="title">
                    {{ __('Delete This Company') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Permanently delete this company and related data') }}
                </x-slot>

                <x-slot name="content">
                    <p>
                        {{ __('All company users, presentations sponsor tiers and booths will be removed.') }}
                    </p>
                </x-slot>

                <x-slot name="actions">
                    <x-danger-button>Remove this team</x-danger-button>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-hub-layout>
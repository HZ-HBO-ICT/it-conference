<x-hub-layout>
    <div id="breadcrumbs" class="pl-5">
        <p class="text-gray-800 dark:text-gray-200"><span class="hover:text-violet-500"><a
                    href="{{route('moderator.requests', 'booths')}}">Booth requests</a></span> /
            <span>{{$booth->team->name}}</span></p>
    </div>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">Booth request details</h1>

    <div class="pl-5 text-gray-800 dark:text-gray-200">
        <h2 class="text-xl py-2">Name of the company: {{$booth->team->name}} </h2>
        <h2 class="text-xl py-2">Sponsorship
                                 tier: {{!$booth->team->sponsorTier ? 'None' : ucfirst($booth->team->sponsorTier->name)}} </h2>
        <h2 class="text-xl pt-2">Additional information for the booth:</h2>
        <p class="text-lg">{{$booth->additional_information}}</p>
        <div>
            <div class="mt-16 flex">
                <form method="POST" action="{{route('moderator.request.booths.approve', [$booth, 1])}}"
                      class="mr-2">
                    @csrf
                    <x-button
                        class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                        Approve
                    </x-button>
                </form>
                <form method="POST" action="{{ route('moderator.request.booths.approve', [$booth, 0]) }}"
                      class="mr-2">
                    @csrf
                    <x-button
                        class="dark:bg-red-500 bg-red-500 hover:bg-red-600 hover:dark:bg-red-600 active:bg-red-600 active:dark:bg-red-600">
                        Disapprove
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-hub-layout>

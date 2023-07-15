<x-hub-layout>
    {{--profile info--}}
    <div class="z-20 w-full mr-8">
        <div class="bg-white dark:bg-gray-800 h-fit overflow-hidden rounded-lg shadow-xl">
            <div class="px-6 py-6 bg-gray-50 dark:bg-gray-800">
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Profile</h2>

                <ul>
                    <li class="pt-16">
                        <p class="text-l text-gray-800 dark:text-gray-200">Name: {{ Auth::user()->name }}</p>
                    </li>
                    <li>
                        <p class="text-l text-gray-800 dark:text-gray-200">Email: {{ Auth::user()->email }}</p>
                    </li>
{{--                    This is for later when we implement organization--}}
{{--                    <li>--}}
{{--                        <p>School/Institution: {{ Auth::user()->institution or whatever we call it }}</p>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
</x-hub-layout>

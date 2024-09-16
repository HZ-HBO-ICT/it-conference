@php use \Illuminate\Support\Facades\Auth @endphp

<div>
    <dl class="pt-11 pb-5 px-6">
        <div
            class="py-5 px-4 rounded-lg overflow-hidden relative bg-partner-100 dark:bg-partner-900 shadow-md dark:shadow-md">
            <dt>
                <div class="p-3 rounded-md absolute bg-partner-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="white"
                         aria-hidden="true" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
                    </svg>
                </div>
            </dt>
            <div class="ml-16 font-semibold text-md text-gray-700 dark:text-gray-100 overflow-hidden text-ellipsis">
                <p>You are part of the people joining {{Auth::user()->company->name}} for the "We are in IT together"
                   conference!<br>
                   When the company representative invited you, they specified that you would be part of the speakers of
                   the company.
                </p>
                <div class="pt-8 grid grid-cols-1">
                    <div class="w-full">
                        To become a speaker you must do the following:
                    </div>
                    @foreach($speakerButtons as $label => $route)
                        @if ($loop->last && count($speakerButtons) > 1)
                            <div class="pt-2">
                                <span>or</span>
                            </div>
                        @endif
                        <div class="pt-2">
                            <!-- As per current implementation, it's an array it must be a POST request;
                            refer the backend of the component for more-->
                            @if(is_array($route))
                                <a href="{{ route($route[0], $route[1]) }}"
                                   class="flex w-full items-center bg-partner-500 hover:bg-partner-700 dark:bg-partner-600 dark:hover:bg-gray-900 text-gray-200 dark:text-white font-semibold justify-center py-2 px-4 w-3/4 rounded-lg transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <span>{{ $label }}</span>
                                </a>
                            @else
                                <a href="{{ route($route) }}"
                                   class="flex w-full items-center bg-partner-500 hover:bg-partner-700 dark:bg-partner-600 dark:hover:bg-gray-900 text-gray-200 dark:text-white font-semibold justify-center py-2 px-4 w-3/4 rounded-lg transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <span>{{ $label }}</span>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </dl>
</div>

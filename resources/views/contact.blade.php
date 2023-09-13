<x-app-layout>
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "{{ env('GOOGLE_MAPS_API_KEY') }}", v: "beta"});

    </script>

    <div class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
        <div class="py-40 max-w-7xl mx-auto">
            @if (session('status'))
{{--            Message for large screens--}}
                <div class="alert-success hidden lg:flex flex-row justify-center items-center" role="alert">
                    <div
                        class="px-5 py-4 text-sm font-medium text-green-800 rounded-lg bg-green-100 dark:bg-gray-700 dark:text-green-400">
                        {{ session('status') }}

                        <button type="button"
                                class="close-alert lg:ml-40 -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-600">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                </div>

{{--            Message for mobile screens--}}
                <div
                     class="alert-success flex lg:hidden flex-col justify-center items-center px-5 py-4 mb-8 text-sm font-medium text-green-800 rounded-lg bg-green-100 dark:bg-gray-700 dark:text-green-400"
                     role="alert">
                    <div class="text-center">
                        {{ session('status') }}
                    </div>

                    <button type="button"
                            class="close-alert mt-6 -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-600">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif

{{--        Form for large screens--}}
            <div class="hidden md:flex lg:flex flex-row space-x-16 justify-center items-start mt-10">
                <x-contact-form />
            </div>

{{--        Form for small screens--}}
            <div class="flex md:hidden lg:hidden flex-col space-y-16 justify-center items-center">
                <x-contact-form />
            </div>

            <p class="tracking-tight leading-10 font-bold text-4xl dark:text-white mt-24 text-center">Our location on
                the map</p>

            <div class="grid mt-10">
                <div>
                    <x-map/>
                </div>
            </div>
        </div>
    </div>

    <script>
        const alertSuccesses = document.querySelectorAll('.alert-success');
        const closeAlertButtons = document.querySelectorAll('.close-alert');


        closeAlertButtons.forEach(button => {
            button.addEventListener('click', () => {
                alertSuccesses.forEach(alert => {
                    alert.parentNode.removeChild(alert);
                });
            });
        });
    </script>
</x-app-layout>

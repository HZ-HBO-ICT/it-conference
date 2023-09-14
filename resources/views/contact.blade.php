<x-app-layout>
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "{{ env('GOOGLE_MAPS_API_KEY') }}", v: "beta"});

    </script>

    <div class="px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
        <div class="pt-40 pb-52 max-w-7xl mx-auto">
            @if (session('status'))
                <div id="alert-success" class="flex md:flex-row lg:flex-row flex-col justify-center items-center px-5 py-3 md:mb-0 lg:mb-0 mb-8 text-sm font-medium text-green-800 rounded-lg bg-green-100 dark:bg-gray-700 dark:text-green-400" role="alert">
                    <div class="text-center">
                        {{ session('status') }}
                    </div>

                    <button id="close-alert" type="button"
                                  class="md:ml-auto lg:ml-auto mt-6 md:mt-0 lg:mt-0 -mx-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-600">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif

            <div class="flex md:px-8 lg:px-8 flex-col md:flex-row lg:flex-row md:space-x-16 lg:space-x-16 space-y-16 justify-center items-center">
                <x-contact-form />
            </div>
        </div>
    </div>

    <script>
        const alertSuccess = document.getElementById('alert-success');
        const closeAlertButton = document.getElementById('close-alert');


        closeAlertButton.addEventListener('click', () => {
            alertSuccess.parentNode.removeChild(alertSuccess);
        });
    </script>
</x-app-layout>

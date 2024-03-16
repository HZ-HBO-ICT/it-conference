<x-app-layout>
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "{{ env('GOOGLE_MAPS_API_KEY') }}", v: "beta"});

    </script>
    <div class="relative bg-cover overflow-hidden min-h-screen">
        <div
            class="before:absolute before:bg-gradient-to-br before:from-gradient-yellow before:via-gradient-pink before:via-gradient-purple before:to-gradient-blue before:opacity-70 before:w-full before:h-full"></div>

        <div
            class="isolate px-6 py-6 max-w-7xl mx-auto my-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="py-40 px-8 max-w-7xl mx-auto">
                <div class="gap-8 grid grid-cols-12">
                    <div class="col-span-12 md:col-span-5">
                        <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Contact Information</h2>
                        <p class="dark:text-gray-200">Het Groene Woud 1-3</p>
                        <p class="dark:text-gray-200">4331 NB Middelburg</p>
                        <a class="text-blue-600 hover:text-blue-400 visited:text-purple-600"
                           href="mailto: info@weareinittogether.nl">info@weareinittogether.nl</a>
                    </div>
                    <div class="col-span-12 md:col-span-5">
                        <x-map/>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

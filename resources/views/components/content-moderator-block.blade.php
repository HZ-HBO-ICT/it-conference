<a href="{{$routeName}}">
    <div class="flex justify-center items-center">
        <div
            class="card w-3/4 rounded-md bg-indigo-950 drop-shadow-l  transition-all duration-300 transform hover:scale-105 hover:cursor-pointer">
            <div class="bg-indigo-700 text-white font-bold rounded-t px-4 py-2">
                {{$label}}
            </div>
            <div class="mt-4 mb-2 w-full h-auto flex flex-col justify-center items-center pb-5">
                <h1
                    class="text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">
                    {{$count}}
                </h1>
            </div>
        </div>
    </div>
</a>

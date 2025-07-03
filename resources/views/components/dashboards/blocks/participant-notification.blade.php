<div
    class="mt-8 p-6 bg-linear-to-r {{Auth::user()->company ? 'from-violet-500 to-fuchsia-500' : 'from-blue-500 to-teal-500'}} rounded-xl shadow-lg text-white">
    {{ $slot }}
</div>

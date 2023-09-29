<div class="mx-20 my-10 p-8 rounded-md bg-white">
    <div class="px-4 sm:px-0">
        <h3 class="text-base font-semibold leading-7 text-gray-900">{{ $title }}</h3>
    </div>
    <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            {{ $slot }}
        </dl>
    </div>
</div>

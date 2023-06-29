<a {{ $attributes->merge(['class' => 'inline-flex items-center px-6 py-4 bg-gray-100 dark:bg-gray-200 border border-transparent rounded-full font-semibold text-sm text-grey-700 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }} href="{{ $href }}">
    {{ $slot }}
</a>

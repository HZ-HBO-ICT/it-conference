<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2 border border-gray-400 rounded-md font-medium text-xs text-white uppercase tracking-widest hover:cursor-pointer hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

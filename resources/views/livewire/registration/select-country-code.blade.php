<div class="relative font-[sans-serif] flex items-center pt-1">
    <div class="relative"> <!-- Add this wrapper for the dropdown-related elements -->
        <button type="button" id="dropdownToggle" wire:click="toggleDropdown"
                class="px-5 py-2.5 rounded-md text-sm border bg-gray-900 text-gray-50 border-gray-700 outline-hidden hover:cursor-pointer hover:bg-gray-900 flex items-center">
            <span class="flag-icon {{current($selected)}} mr-3"></span>
            {{key($selected)}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-[#333] dark:fill-gray-300 ml-3" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                      d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                      clip-rule="evenodd" data-original="#000000" />
            </svg>
        </button>
        <ul id="dropdownMenu" class='absolute {{$isHidden ? 'hidden' : 'block'}} shadow-lg bg-gray-900 text-gray-50 py-2 px-2 z-1000 min-w-full rounded-sm overflow-auto max-h-56'>
            <li class="mb-2">
                <input wire:model.live="filterCode" placeholder="Search..."
                       class="px-4 py-2.5 w-full rounded-sm  text-sm text-gray-50 bg-gray-800 border-none outline-teal-600 bg-slate-950 focus:bg-transparent" />
            </li>
            @forelse($filteredFlags as $code => $flagClass)
                <li class='py-2.5 px-4 hover:bg-gray-700 rounded-sm ext-gray-50 text-sm cursor-pointer' wire:click="chooseCountry('{{ $code }}')">
                    <div class="flex items-center">
                        <span class="flag-icon {{$flagClass}} mr-3"></span>
                        {{$code}}
                    </div>
                </li>
            @empty
                <li class='py-2.5 px-4 rounded-sm text-black text-sm'>
                    <div class="flex items-center">
                        No matching records
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
    <x-waitt.input wire:model.live="phoneNumber" id="company_phone_number" placeholder="1234 56789" class="block ml-2 w-full" type="tel" name="companyPhoneNumber" wire:model="companyPhoneNumber"></x-waitt.input>
</div>

@script
<script>
    const inputField = document.getElementById('company_phone_number');

    inputField.addEventListener('input', function () {
        let value = inputField.value;

        // Remove all non-digit characters
        value = value.replace(/\D+/g, '');

        // Apply spacing after the first 4 digits
        value = value.substring(0, 4) + (value.length > 4 ? ' ' + value.substring(4, 9) : '');

        // Set the formatted value back to the input
        inputField.value = value;
    });
</script>
@endscript

<div class="w-full h-full flex items-center flex-row-reverse rounded-lg bg-radial-[at_50%_120%] from-[#1B0630] to-[#0B0B0B] to-90%">
    <div class="mr-2 p-2 rounded-lg bg-fuchsia-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
             aria-hidden="true" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
        </svg>
    </div>
    <div class="flex-1 ml-5 text-white items-start text-left">
        <p class="text-xs font-semibold">{{ $label }} status</p>
        <p class="text-sm font-bold text-{{\App\Enums\ApprovalStatus::colorFromValue($status)}}-200">{{ ucfirst(str_replace('_', ' ', $status)) }}</p>
    </div>
</div>

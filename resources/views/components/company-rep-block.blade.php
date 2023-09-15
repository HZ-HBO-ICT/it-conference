@php
    $status = '';

    if ($label === 'Company status') {
        if(\Illuminate\Support\Facades\Auth::user()->currentTeam->is_approved == 1)
            $status = 'Approved';
        else
            $status = 'Awaiting approval';
        }
    elseif ($label === 'Booth status') {
        if(!\Illuminate\Support\Facades\Auth::user()->currentTeam->booth)
            $status = 'Not requested';
        else {
            if(\Illuminate\Support\Facades\Auth::user()->currentTeam->booth->is_approved == 1)
                $status = 'Approved';
            else
                $status = 'Awaiting approval';
        }
    } elseif ($label === 'Sponsorship status') {
        if(!\Illuminate\Support\Facades\Auth::user()->currentTeam->sponsorTier)
            $status = 'Not requested';
        else {
            if(\Illuminate\Support\Facades\Auth::user()->currentTeam->is_sponsor_approved == 1)
                $status = 'Approved';
            else
                $status = 'Awaiting approval';
        }
    }

        $accentColor = $status === 'Approved' ? 'purple' : ($status === 'Awaiting approval' ? 'yellow' : 'gray')
@endphp

<div
    class="py-5 px-4 rounded-lg overflow-hidden relative bg-white dark:bg-gray-800 shadow-md dark:shadow-md dark:">
    <dt>
        <div class="p-3 rounded-md absolute bg-purple-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                 aria-hidden="true" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
            </svg>
        </div>
        <p class="ml-16 font-semibold text-md text-gray-500 dark:text-gray-100 overflow-hidden text-ellipsis whitespace-nowrap">
            {{ $label }}
        </p>
    </dt>
    <dd class="items-baseline flex ml-16">
        <p class="text-{{$accentColor}}-600 font-medium text-md dark:text-{{$accentColor}}-500">
            {{$status}}
        </p>
    </dd>
</div>

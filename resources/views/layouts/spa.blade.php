@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Presentation;
    use App\Models\Edition;
@endphp

<x-app-layout>
    <div class="grow overflow-y-auto bg-gray-100 dark:bg-gray-900">
        {{ $slot }}
    </div>
</x-app-layout>

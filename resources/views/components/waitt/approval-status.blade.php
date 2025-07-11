@php
    $color = match ($status) {
        'approved' => 'text-teal-300',
        'awaiting_approval' => 'text-yellow-300',
        'rejected' => 'text-red-300',
        default => 'text-gray-400',
    };

    $label = ucfirst(str_replace('_', ' ', $status));
@endphp

<p class="text-xs opacity-50 {{ $color }}">
    {{ $label }}
</p>

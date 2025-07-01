@php
    $presets = [
        'gold' => ['bg' => 'bg-gold', 'text' => 'text-gold-light'],
        'silver' => ['bg' => 'bg-silver', 'text' => 'text-silver-light'],
        'bronze' => ['bg' => 'bg-bronze', 'text' => 'text-bronze-light'],
    ];

    $lower = strtolower($title);
    $bgClass = $bg ?? ($presets[$lower]['bg'] ?? 'bg-gray-300');
    $textClass = $text ?? ($presets[$lower]['text'] ?? 'text-white');
@endphp

<span class="inline-block px-4 py-1 rounded-full text-sm font-semibold mb-6 uppercase tracking-wide {{ $bgClass }} {{ $textClass }}">
    {{ $title }}
</span>

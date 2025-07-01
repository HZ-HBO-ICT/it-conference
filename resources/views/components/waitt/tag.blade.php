@php
    $presets = [
        'gold' => ['bg' => 'bg-gold', 'text' => 'text-gold-light'],
        'silver' => ['bg' => 'bg-silver', 'text' => 'text-silver-light'],
        'bronze' => ['bg' => 'bg-bronze', 'text' => 'text-bronze-light'],
    ];

    $lower = strtolower($title);
    $bgClass = $bg ?? ($presets[$lower]['bg'] ?? 'bg-gray-300');
    $textClass = $text ?? ($presets[$lower]['text'] ?? 'text-white');
    $textSize = $textSize ?? 'text-sm';
@endphp

<span class="inline-block {{ $textSize == 'text-xs' ? 'px-2' : 'px-4'  }} py-1 rounded-full {{ $textSize ?? 'text-sm' }} font-semibold uppercase {{ $textSize != 'text-xs' ? 'tracking-wide' : '' }} {{ $bgClass }} {{ $textClass }}">
    {{ $title }}
</span>

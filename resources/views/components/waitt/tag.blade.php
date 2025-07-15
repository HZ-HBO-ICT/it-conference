@php
    $presets = [
        'gold' => ['bg' => 'bg-gold', 'text' => 'text-gold-light'],
        'silver' => ['bg' => 'bg-silver', 'text' => 'text-silver-light'],
        'bronze' => ['bg' => 'bg-bronze', 'text' => 'text-bronze-light'],
        'beginner' => ['bg' => 'bg-waitt-cyan', 'text' => 'text-cyan-700'],
        'intermediate' => ['bg' => 'bg-waitt-yellow', 'text' => 'text-yellow-600'],
        'expert' => ['bg' => 'bg-waitt-pink', 'text' => 'text-pink-800'],
        'approved' => ['bg' => 'bg-green-600/60', 'text' => 'text-green-200' ],
        'awaiting approval' => ['bg' => 'bg-yellow-500/60', 'text' => 'text-yellow-200' ],
    ];

    $lower = strtolower($title);
    $bgClass = $bg ?? ($presets[$lower]['bg'] ?? 'bg-gray-300');
    $textClass = $text ?? ($presets[$lower]['text'] ?? 'text-white');
    $textSize = $textSize ?? 'text-sm';
    $uppercase = $uppercase ?? true;
@endphp

<span class="inline-block w-fit {{ $textSize == 'text-xs' ? 'px-2' : 'px-4'  }} py-1 rounded-full {{ $textSize ?? 'text-sm' }} font-semibold {{ $uppercase ? 'uppercase' : ''}} {{ $textSize != 'text-xs' ? 'tracking-wide' : '' }} {{ $bgClass }} {{ $textClass }}">
    {{ $title }}
</span>

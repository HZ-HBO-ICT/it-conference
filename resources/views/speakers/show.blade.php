@php
    // Unified badge style definitions
    $badgeStyles = [
        1 => ['label' => 'GOLD',   'bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'border' => 'border-yellow-400'],
        2 => ['label' => 'SILVER', 'bg' => 'bg-gray-100',   'text' => 'text-gray-800',  'border' => 'border-gray-400'],
        3 => ['label' => 'BRONZE', 'bg' => 'bg-orange-100', 'text' => 'text-orange-800','border' => 'border-orange-400'],
    ];

    // Determine speaker badge style
    $badge = optional($speaker->user->company)->is_sponsorship_approved
           ? $speaker->user->company->sponsorship_id
           : null;
    $style = $badge ? $badgeStyles[$badge] : null;
@endphp

<x-app-layout>
  <section class="min-h-screen py-20 px-6 lg:px-12 relative overflow-hidden">
    <!-- Decorative Blobs Background -->
    <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
    <div class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
    <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
    <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
    <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
    <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
    <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
    <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
    <!-- End Blobs -->
    <div class="max-w-6xl mx-auto grid grid-cols-1 xl:grid-cols-3 gap-16 items-start">

      {{-- LEFT CARD: Speaker Info --}}
      <aside class="col-span-1 bg-dark-card z-10 rounded-3xl shadow-2xl border-4 {{ $style['border'] ?? 'border-gray-700' }} p-10 space-y-8">
        {{-- Profile Photo or Initials --}}
        <div class="flex justify-center">
          @if($speaker->user->profile_photo_url)
            <img src="{{ $speaker->user->profile_photo_url }}"
                 alt="{{ $speaker->user->name }}"
                 class="h-32 w-32 rounded-full shadow-xl border-4 border-opacity-30" />
          @else
            <div class="h-32 w-32 rounded-full bg-gray-700 flex items-center justify-center">
              <span class="text-4xl text-gray-300">{{ strtoupper(substr($speaker->user->name, 0, 2)) }}</span>
            </div>
          @endif
        </div>

        {{-- Name & Badge --}}
        <div class="text-center">
          <h2 class="text-3xl font-bold text-white">{{ $speaker->user->name }}</h2>
          @if($style)
            <span class="mt-3 inline-block px-5 py-2 text-base font-semibold uppercase rounded-full border-2
                         {{ $style['bg'] }} {{ $style['text'] }} {{ $style['border'] }}">
              {{ $style['label'] }}
            </span>
          @endif
        </div>

        {{-- Company / Contact details --}}
        <div class="space-y-4 text-gray-300 text-base">
          <p><strong>Company:</strong> {{ $speaker->user->company->name ?? 'Independent' }}</p>
          <p><strong>Email:</strong> {{ $speaker->user->email ?? 'Not specified' }}</p>
          <p><strong>City:</strong> {{ $speaker->user->city ?? 'Not specified' }}</p>
        </div>

        {{-- Website Button (if provided) --}}
        @if($speaker->user->company && $speaker->user->company->website)
          <div class="text-center">
            <a href="{{ $speaker->user->company->website }}" target="_blank"
               class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-full py-3 px-8 text-lg">
              Visit website
            </a>
          </div>
        @endif
      </aside>

      {{-- RIGHT PANEL: About & Presentation --}}
      <article class="col-span-2 space-y-12">
        {{-- About Section --}}
        <div>
          <h3 class="text-2xl font-semibold text-white mb-3">About</h3>
          <p class="text-gray-400 leading-relaxed text-lg">
            {{ $speaker->presentation->description ?? 'No description available.' }}
          </p>
        </div>

        {{-- Divider --}}
        <hr class="border-gray-700">

        {{-- Presentation Title --}}
        @if($speaker->presentation->name)
          <div>
            <h3 class="text-2xl font-semibold text-white mb-3">Presentation</h3>
            <p class="italic text-gray-300 text-lg">
              {{ $speaker->presentation->name }}
            </p>
          </div>
        @endif
      </article>

    </div>
  </section>
</x-app-layout>

@php use App\Models\Company; @endphp
<x-hub-layout>
    <div class="min-h-screen relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 md:px-8 bg-waitt-dark">
        <!-- Decorative Blobs Background -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
        </div>
        
        <div class="relative z-10 max-w-4xl mx-auto">
            <div class="mb-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white mb-2">
                    {{ __('Create a booth') }}
                </h2>
                <p class="text-base sm:text-lg text-gray-300">
                    Add manually the booth for an already registered company
                </p>
            </div>
            
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl">
                <livewire:booth.create-booth/>
            </div>
        </div>
    </div>
</x-hub-layout>

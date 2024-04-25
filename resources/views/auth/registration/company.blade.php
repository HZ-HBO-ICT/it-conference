<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: bg-partner-500 bg-partner-600 bg-partner-700 -->
<x-app-layout>
    <div class="md:py-20 h-max md:h-auto flex items-center justify-center bg-gray-100 dark:bg-gray-900 md:px-40 ">
        <livewire:registration.parent-component/>
    </div>
</x-app-layout>

<script src="/js/registration-validation.js"></script>

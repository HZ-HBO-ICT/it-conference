<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: bg-partner-500 bg-partner-600 bg-partner-700 -->
@php
    $bodyOfDialog = "The difference between the roles is actually quite simple.<br>If you want to join the conference to
                        visit company booths, join presentations or maybe even become a speaker - you should enrol just
                        as a participant.<br>If you would like to join as a company - to invite more company members to
                        join you, manage the company booth and requests, then you should join as company and you'll
                        become the company representative as soon as you are approved from our team."
@endphp
<x-app-layout>
    <div class="md:py-20 h-max md:h-auto flex items-center justify-center bg-gray-100 dark:bg-gray-900 md:px-40 ">
        <livewire:registration.parent-component></livewire:registration.parent-component>
    </div>
</x-app-layout>

<script src="/js/registration-toggle.js"></script>

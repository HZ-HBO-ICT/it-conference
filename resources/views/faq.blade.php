<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Frequently Asked Questions') }}
        </h2>
        <p class="mt-2">
            Have a different question and can't find the answer you're looking for? 
            <br>
            Reach out to our team at <a class="text-blue-600 visited:text-purple-600" href="mailto:user@email.nl">user@email.nl</a> and we'll get back to you as soon as we can.
        </p>
    </x-slot>

    <div class="flex justify-center">
        <dl class="grid grid-cols-2 gap-x-10 gap-y-16">
            <div>
                <dt class="leading-7 ">Test</dt>
                <dd class="">test</dd>
            </div>
            <div>
                <dt class=""></dt>
                <dd class="">test</dd>
            </div>
        </div>
    </div>


    
</x-app-layout>

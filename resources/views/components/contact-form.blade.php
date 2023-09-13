<div>
    <div>
        <h2 class="tracking-tight leading-10 font-bold text-4xl dark:text-white">Got a question?</h2>
        <p class="dark:text-gray-200 mt-3">Fill in the form, and we will get</p>
        <p class="dark:text-gray-200">back to you as soon as possible.</p>
    </div>

    <div class="mt-20">
        <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Contact
            Information</h2>
        <p class="dark:text-gray-200 mt-3">Het Groene Woud 1-3</p>
        <p class="dark:text-gray-200">4331 NB Middelburg</p>
        <a class="text-blue-600 hover:text-blue-400 visited:text-purple-600"
           href="mailto: info@weareinittogether.nl">info@weareinittogether.nl</a>
    </div>
</div>

<div>
    <form class="flex flex-col w-80" action="{{ route('contact.store') }}" method="POST">
        @csrf
        @method('POST')

        <x-label for="name" value="{{ __('Name') }}"
                 class="after:content-['*'] after:text-red-500 text-xl"/>
        <x-input type="text" class="block mt-3 w-full" id="name" name="name" :value="old('name')"
                 placeholder="e.g. John Doe" required
                 autofocus autocomplete="name"/>
        @error('name')
        <p class="text-red-500">{{ $message }}</p>
        @enderror

        <x-label for="email" value="{{ __('Email') }}"
                 class="mt-10 after:content-['*'] after:text-red-500 text-xl"/>
        <x-input type="text" class="block mt-3 w-full" id="email" name="email" :value="old('email')"
                 placeholder="e.g. youremail@gmail.com" required
                 autofocus autocomplete="email"/>
        @error('email')
        <p class="text-red-500">{{ $message }}</p>
        @enderror

        <x-label for="message" value="{{ __('Message') }}"
                 class="mt-10 after:content-['*'] after:text-red-500 text-xl"/>
        <textarea type="text"
                  class="block mt-3 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                  id="message" name="message" required
                  autofocus autocomplete="message">{{ old('message') }}</textarea>
        @error('message')
        <p class="text-red-500">{{ $message }}</p>
        @enderror

        <x-button class="mt-10 w-fit">
            {{ __('Send') }}
        </x-button>
    </form>
</div>

<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add a new FAQ') }}
        </h2>
        <div class="pt-5">
            <form method="POST" action="{{route('moderator.faqs.store')}}">
                @csrf
                <x-action-section>
                    <x-slot name="title">
                        {{ __('FAQ information') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('In order to show the answer in the most appropriate way we use Markdown syntax. Not all of the syntax is currently supported. Refer to the tool bar or to the help button next to it in the text area to see the syntax that is supported.') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="pr-5">
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="question" value="Question"></x-label>
                                <x-input id="question" name="question" type="text" maxlength="255"
                                         value="{{ old('question') }}"
                                         class="mt-1 block w-full "
                                ></x-input>
                                <x-input-error for="question" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 py-4">
                                <x-markdown-editor value="{{ old('answer') }}" :name="'answer'" :label="'Answer'" />
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="actions">
                        <x-button
                            type="submit"
                            class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                            Save
                        </x-button>
                    </x-slot>
                </x-action-section>
            </form>
        </div>
    </div>
</x-hub-layout>

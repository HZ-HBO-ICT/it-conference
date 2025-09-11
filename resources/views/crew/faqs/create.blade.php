<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Company details') }}
        </h2>
    </div>
    <div class="py-5">
        <form method="POST" action="{{route('moderator.faqs.store')}}">
            @csrf
            <x-waitt.action-section>
                <x-slot name="title">
                    {{ __('FAQ information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('In order to show the answer in the most appropriate way we use Markdown syntax. Not all of the syntax is currently supported. Refer to the tool bar or to the help button next to it in the text area to see the syntax that is supported.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="pr-5">
                        <div class="col-span-6 sm:col-span-4">
                            <x-waitt.label for="question" value="Question"></x-waitt.label>
                            <x-waitt.input id="question" name="question" type="text" maxlength="255"
                                     value="{{ old('question') }}"
                                     class="mt-1 block w-full "
                            ></x-waitt.input>
                            <x-input-error for="question" class="mt-2"></x-input-error>
                        </div>
                        <div class="col-span-6 sm:col-span-4 py-4">
                            <x-markdown-editor value="{{ old('answer') }}" :name="'answer'" :label="'Answer'"/>
                        </div>
                    </div>
                </x-slot>
                <x-slot name="actions">
                    <x-waitt.button
                        type="submit"
                        variant="save"
                    >
                        Save
                    </x-waitt.button>
                </x-slot>
            </x-waitt.action-section>
        </form>
    </div>
</x-crew-colorful-layout>

@php use App\Models\Difficulty; @endphp
<x-hub-layout>
    <div class="py-8 mx-auto max-w-7xl">
        <div class="px-8">
            <h2 class="font-semibold text-3xl text-gray-50 leading-tight">
                {{ __('Give feedback') }}
            </h2>
            <h2 class="text-md text-gray-200 pt-2">
                As a team, we are always striving to improve! If you have any suggestions or have encountered issues with the website or the organization, please let us know! Or if everything is perfect, we also would like to hear from you!
            </h2>
            <div class="mt-5">
                <form method="POST" action="{{route('feedback.store')}}">
                    @csrf
                    <div class="flex flex-col space-y-5">
                        <div>
                            <x-waitt.label for="title" value="Title" class="after:content-['*'] after:text-red-500"/>
                            <x-waitt.input id="title" name="title" maxlength="255" value="{{old('title')}}" type="text" class="mt-1 block w-full"/>
                            <x-input-error for="title" class="mt-2"/>
                        </div>
                        <div>
                            <x-waitt.label for="type" value="Select the area your feedback relates to" class="after:content-['*'] after:text-red-500"/>
                            <select name="type" class="mt-1 block w-full bg-gray-900 border-gray-600 text-gray-300 rounded-lg focus:border-teal-600 focus:ring-teal-600 ">
                                <option selected value="website">Website</option>
                                <option value="organization">Organization</option>
                            </select>
                            <x-input-error for="type" class="mt-2"/>
                        </div>
                        <div>
                            <x-waitt.label for="content" value="Content" class="after:content-['*'] after:text-red-500 pb-1"/>
                            <x-markdown-editor value="{{ old('content') }}" :name="'content'" />
                            <x-input-error for="content" class="mt-2"/>
                        </div>
                        <div>
                            <x-waitt.button
                                type="submit"
                                variant="edit"
                            >
                                Submit
                            </x-waitt.button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-hub-layout>

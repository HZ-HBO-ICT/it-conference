@php use App\Models\Company; @endphp
<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a booth') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Booth details') }}
                </x-slot>
                <x-slot name="description">
                    <div class="space-y-4 text-gray-800 dark:text-gray-200 text-sm">
                        <p>Add manually the booth for an already registered company.</p>
                        <p class="mt-4">Total area sized mentioned in the sponsor packages:</p>
                        <ul class="list-disc ml-6">
                            <li>Bronze & Silver - 8 m<sup>2</sup></li>
                            <li>Golden - 12 m<sup>2</sup></li>
                        </ul>
                    </div>
                </x-slot>


                <x-slot name="content">
                    <div class="pr-5">
                        <form method="POST" action="{{route('moderator.booths.store')}}">
                            @csrf
                            <div class="col-span-6 sm:col-span-4 ">
                                <x-label for="company_id" class="after:content-['*'] after:text-red-500" value="{{ __('Company name') }}"></x-label>
                                <x-select name="company_id" class="mt-1 block w-full">
                                    @foreach(Company::whereDoesntHave('booth')
                                                ->where('is_approved', '=', '1')->get() as $company)
                                        <option value="{{ $company->id }}">
                                            {{$company->name}}
                                            @if($company->sponsorship)
                                                ({{ucfirst($company->sponsorship->name)}} sponsor)
                                            @endif
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-input-error for="company_id" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pt-3">
                                <x-label for="width" class="after:content-['*'] after:text-red-500" value="{{ __('Width') }}"></x-label>
                                <x-input name="width" type="number" class="mt-1 block w-full"
                                         value="{{ old('width') }}"></x-input>
                                <x-input-error for="width" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pt-3">
                                <x-label for="length" class="after:content-['*'] after:text-red-500" value="{{ __('Length') }}"></x-label>
                                <x-input name="length" type="number" class="mt-1 block w-full"
                                         value="{{ old('length') }}"></x-input>
                                <x-input-error for="length" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pt-3">
                                <x-label for="description" value="{{ __('Additional information') }}"></x-label>
                                <textarea name="additional_information"
                                          class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                                          name="description"
                                >{{old('additional_information')}}</textarea>
                            </div>
                            <div id="calculatedArea" class="mt-2 text-sm text-gray-600 dark:text-gray-400"></div>
                            <x-button
                                class="mt-5 dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                                Create
                            </x-button>
                        </form>
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const widthInput = document.querySelector('input[name="width"]');
            const heightInput = document.querySelector('input[name="height"]');

            const calculatedAreaElement = document.getElementById('calculatedArea');

            widthInput.addEventListener('input', calculateArea);
            heightInput.addEventListener('input', calculateArea);

            function calculateArea() {
                const width = parseFloat(widthInput.value) || 0;
                const height = parseFloat(heightInput.value) || 0;
                const area = width * height;

                calculatedAreaElement.textContent = `Calculated Area: ${area} m²`;
            }
        });
    </script>

</x-hub-layout>

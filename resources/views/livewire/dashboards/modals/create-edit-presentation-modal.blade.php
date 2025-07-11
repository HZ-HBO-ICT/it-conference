@php use App\Models\Presentation; @endphp
<x-waitt.modal form-action="save" wire:key="{{ optional($presentation)->id ?? 'new-presentation' }}">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        {{ $presentation ? 'Update presentation' : 'Request presentation'}}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="relative md:col-span-2 border border-gray-700 rounded-lg p-6 space-y-4">
                <span
                    class="absolute -top-3 left-3 px-2 py-0.5 text-xs font-semibold uppercase tracking-wide
                           bg-gray-900 text-gray-400 rounded">
                    Details
                </span>

                <div>
                    <x-waitt.label for="name" value="Name"/>
                    <x-waitt.input id="name" type="text" class="mt-1 block w-full"
                                   :disabled="$presentation && Auth::user()->cannot('update', $presentation)"
                                   wire:model.defer="form.name"/>
                    @error('form.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-waitt.label for="description" value="Description"/>
                    <x-waitt.input-textarea id="description" class="mt-1 block w-full"
                                            :disabled="$presentation && Auth::user()->cannot('update', $presentation)"
                                            wire:model.defer="form.description"/>
                    @error('form.description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-1">
                        <x-waitt.label for="presentation_type_id" value="Presentation Type"/>
                        <select id="presentation_type_id"
                                wire:model.defer="form.presentation_type_id"
                                @if($presentation && Auth::user()->cannot('update', $presentation)) disabled @endif
                                class="mt-1 block w-full bg-gray-900 border-gray-600 text-gray-300 rounded-lg">
                            <option value="">Choose type</option>
                            @foreach($presentationTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('form.presentation_type_id') <span
                            class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <x-waitt.label for="difficulty_id" value="Difficulty"/>
                        <select id="difficulty_id"
                                @if($presentation && Auth::user()->cannot('update', $presentation)) disabled @endif
                                wire:model.defer="form.difficulty_id"
                                class="mt-1 block w-full bg-gray-900 border-gray-600 text-gray-300 rounded-lg">
                            <option value="">Choose difficulty</option>
                            @foreach($difficulties as $difficulty)
                                <option value="{{ $difficulty->id }}">{{ ucfirst($difficulty->level) }}</option>
                            @endforeach
                        </select>
                        @error('form.difficulty_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <x-waitt.label for="max_participants" value="Max Participants"/>
                        <x-waitt.input id="max_participants" type="number" min="1" max="999"
                                       class="mt-1 block w-full"
                                       :disabled="$presentation && Auth::user()->cannot('update', $presentation)"
                                       wire:model.defer="form.max_participants"/>
                        @error('form.max_participants') <span
                            class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="relative flex flex-col justify-center items-center border border-gray-700 rounded-lg p-6">
                <span
                    class="absolute -top-3 left-3 px-2 py-0.5 text-xs font-semibold uppercase tracking-wide
                           bg-gray-900 text-gray-400 rounded">
                    Slides
                </span>

                @if($presentation)
                    <div class="w-full">
                        <label class="block w-full cursor-pointer">
                            <div>
                                @if($file && !$errors->has('file') )
                                    <div class="mt-2">
                                        <p class="text-gray-500 text-sm">Uploaded file: {{ $file->getClientOriginalName() }}</p>
                                    </div>
                                @elseif($presentation->file_original_name)
                                    <p wire:click="downloadFile" class="text-sm text-white mb-3 hover:text-waitt-yellow">Download {{$presentation->file_original_name}}</p>
                                @else
                                    <p class="text-gray-400">No slides uploaded</p>
                                @endif
                            </div>
                            @can('update', $presentation)
                                @if($file)
                                    <div class="py-2">
                                        <button type="submit"
                                                class="flex items-center hover:cursor-pointer justify-center w-full h-12 bg-gray-900 text-teal-600 text-sm rounded-lg border border-teal-600 hover:bg-gray-700 transition">
                                            Save
                                        </button>
                                    </div>
                                @endif
                                <div>
                                    <input
                                        type="file"
                                        id="logo"
                                        accept="application/pdf, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation"
                                        wire:model="file"
                                        class="sr-only"/>
                                    <div
                                        class="flex items-center justify-center w-full h-12 bg-gray-900 text-gray-300 text-sm rounded-lg border border-gray-600 hover:bg-gray-700 transition">
                                        Choose File
                                    </div>
                                </div>
                            @endcan
                        </label>

                        @error('file')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                @else
                    <p class="text-gray-400 text-sm text-center">
                        You would be able to upload slides for your presentation after it has been approved.
                    </p>
                @endif
            </div>
        </div>

    </x-slot>

    <x-slot name="buttons">
        <div wire:dirty>
            @if($presentation)
                @can('update', $presentation)
                    <x-waitt.button type="button" wire:click="cancel">Cancel</x-waitt.button>
                    <x-waitt.button type="submit" variant="save">Save</x-waitt.button>
                @endcan
            @else
                @can('request', Presentation::class)
                    <x-waitt.button type="button" wire:click="cancel">Cancel</x-waitt.button>
                    <x-waitt.button type="submit" variant="save">Save</x-waitt.button>
                @endcan
            @endif
        </div>
        @if($joinAsSpeaker)
            <x-waitt.button type="button" class="border-waitt-pink text-waitt-pink" wire:click="becomeSpeaker">Join as co-speaker</x-waitt.button>
        @endif
    </x-slot>
</x-waitt.modal>

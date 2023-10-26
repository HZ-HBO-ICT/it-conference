<div class="pb-3 pr-7">
    <label for="presentation" class="text-sm">Replace with presentation:</label>
    <select name="presentation_id" id="presentation" wire:model="newPresentationId"
            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-crew-500 focus:border-crew-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-crew-500 dark:focus:border-crew-500">
        @forelse($availablePresentations as $presentation)
            <option>{{$presentation->name}}</option>
        @empty
            <option>No available presentations</option>
        @endforelse
    </select>
    @if($availablePresentations->count() > 0)
        <x-button wire:click="replace"
                  class="mt-5 dark:bg-crew-500 bg-crew-500 hover:bg-crew-600 hover:dark:bg-crew-600 active:bg-green-600 active:dark:bg-green-600">
            Replace
        </x-button>
    @endif
</div>

<div>
    <form wire:submit.prevent="updateDifficulty">
        @csrf
        <div class="pb-3 pr-7">
            <label for="room">Select difficulty level:</label>
            <select name="difficulty_selector" wire:model="selectedDifficultyId"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                @foreach (\App\Models\Difficulty::all() as $difficulty)
                    @if($presentation->difficulty->id == $difficulty->id)
                        <option selected value="{{ $difficulty->id }}">{{ ucfirst($difficulty->level) }}</option>
                    @else
                        <option value="{{ $difficulty->id }}">{{ ucfirst($difficulty->level) }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <button class="bg-indigo-800 hover:bg-indigo-700 text-white py-2 px-4 rounded-sm">
            Save
        </button>
        @if (session()->has('message'))
            <div class="text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif
    </form>
</div>

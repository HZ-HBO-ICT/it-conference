<?php

namespace App\Livewire\PresentationType;

use App\Models\Edition;
use App\Models\PresentationType;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportRedirects\Redirector;
use LivewireUI\Modal\ModalComponent;
use function PHPUnit\Framework\isNull;

class CreateEditModal extends ModalComponent
{
    public PresentationType $presentationType;

    public ?int $presentationTypeId;

    public int $editionId;

    /**
     * @var string[]
     */
    public array $colours;

    public string $name;

    public string $description;

    public int $duration;

    public string $colour;
    public string $colourUsedBy;

    /**
     * Mounts the modal
     * @param int $editionId
     * @param int|null $presentationTypeId
     * @return void
     */
    public function mount(int $editionId, ?int $presentationTypeId = null) : void
    {
        $this->colour = '';

        if (!is_null($presentationTypeId)) {
            $this->presentationTypeId = $presentationTypeId;
            $presentationType = PresentationType::find($presentationTypeId);
            if ($presentationType) {
                $this->presentationType = $presentationType;
                $this->name = $this->presentationType->name;
                $this->description = $this->presentationType->description;
                $this->duration = $this->presentationType->duration;
                $this->colour = $this->presentationType->colour;
            }
        }

        $this->colourUsedBy = '';
        $this->colours = config('colours');
        $this->editionId = $editionId;
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:255',
            'duration' => 'required|min:10|max:720|integer',
            'colour' => [
                'required',
                Rule::in($this->colours),
            ],
        ];
    }

    /**
     * Validates the data and creates new presentation type
     * @return void
     * @throws AuthorizationException
     */
    public function store(): void
    {
        $this->authorize('create', PresentationType::class);

        $validated = $this->validate();

        PresentationType::create(array_merge($validated, ['edition_id' => $this->editionId]));

        session()->flash('flash.banner', "Presentation type {$this->name} successfully created.");
        $this->redirect(route('moderator.editions.show', Edition::find($this->editionId)));
    }

    /**
     * Validates the data and updates the presentation type
     * @return void
     * @throws AuthorizationException
     */
    public function update(): void
    {
        $this->authorize('update', $this->presentationType);

        if ($this->getWarningMessage()) {
            $this->presentationType->presentations()->update([
                'room_id' => null,
                'timeslot_id' => null,
                'start' => null,
            ]);
        }

        $validated = $this->validate();

        $this->presentationType->update($validated);

        session()->flash('flash.banner', "Presentation type {$this->presentationType->name} successfully updated.");
        $this->redirect(route('moderator.editions.show', $this->presentationType->edition));
    }

    public function updatedDuration($value)
    {
        $this->duration = is_numeric($value) ? (int) $value : 0;
    }

    public function updatedColour($value) {
        $this->colourUsedBy = '';
        $usedBy = PresentationType::where('colour', $value)->first();

        if ($usedBy && $this->presentationType) {
          $this->colourUsedBy = $usedBy->id != $this->presentationType->id ? $usedBy->name : '';
        }
    }

    public function getWarningMessage() : bool
    {
        if (!$this->presentationTypeId || !$this->presentationType) {
            return false;
        }

        return !$this->presentationType->canBeSafelyUpdated() &&
            $this->presentationType->duration !== $this->duration;
    }


    /**
     * Sets the maximum width of the modal according to docs
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.presentation-type.create-edit-modal');
    }
}

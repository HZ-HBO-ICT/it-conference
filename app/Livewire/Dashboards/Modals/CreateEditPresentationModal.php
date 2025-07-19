<?php

namespace App\Livewire\Dashboards\Modals;

use App\Livewire\Forms\PresentationForm;
use App\Models\Difficulty;
use App\Models\Edition;
use App\Models\Presentation;
use App\Models\PresentationType;
use App\Models\User;
use App\Traits\FileValidation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CreateEditPresentationModal extends ModalComponent
{
    use WithFileUploads;
    use FileValidation;

    public PresentationForm $form;
    public ?Presentation $presentation = null;
    public bool $joinAsSpeaker;
    public User $user;
    public TemporaryUploadedFile|null $file = null;

    /** @var Collection<int, PresentationType> */
    public $presentationTypes;
    /** @var Collection<int, Difficulty> */
    public $difficulties;
    public string $filename;

    /**
     * Initializes the component
     * @param User $user
     * @param int|null $presentationId
     * @return void
     */
    public function mount(User $user, ?int $presentationId, bool $joinAsSpeaker = false) : void
    {
        $this->user = $user;
        $this->presentationTypes = optional(Edition::current())->presentationTypes;
        $this->difficulties = Difficulty::all();
        $this->joinAsSpeaker = $joinAsSpeaker;

        if ($presentationId) {
            $this->presentation = Presentation::findOrFail($presentationId);
            $this->form->setPresentation($this->presentation);
        }
    }

    /**
     * Saves the form
     * @return void
     */
    public function save() : void
    {
        $this->validate();

        if ($this->presentation) {
            $this->authorize('update', $this->presentation);
            $this->form->update();

            if ($this->file) {
                $this->validate([
                    'file' => [
                        'file',
                        'max:10240',
                        'mimetypes:application/pdf,application/vnd.ms-powerpoint,application
                /vnd.openxmlformats-officedocument.presentationml.presentation',
                    ],
                ], [
                    'file.max' => 'The file must not be larger than 10MB',
                    'file.mimetypes' => 'The file must be a pdf, powerpoint, or presentation document',
                ]);

                Storage::delete('presentations' . explode('@', $this->user->email)[0] . '-presentation');
                $path = $this->file->storeAs('presentations', explode('@', $this->user->email)[0] . '-presentation');
                $this->presentation->file_path = $path !== false ? $path : null;
                $this->presentation->file_original_name = $this->file->getClientOriginalName();
                $this->presentation->save();
            }

            $this->presentation->refresh();
            Toaster::success("Presentation {$this->presentation->name} has been updated");
        } else {
            $this->authorize('request', Presentation::class);
            $this->form->create($this->user);
            Toaster::success("The presentation has been created");
        }

        $this->dispatch('updated-dashboard');
        $this->closeModal();
    }

    /**
     * Validates the uploaded file before showing the preview
     * @return void
     * @throws ValidationException
     */
    public function updatedFile() : void
    {
        if ($this->file) {
            $this->validateFileNameLength($this->file, 'file');

            $this->validate([
                'file' => [
                    'file',
                    'max:10240',
                    'mimetypes:application/pdf,application/vnd.ms-powerpoint,application
                /vnd.openxmlformats-officedocument.presentationml.presentation',
                ]
            ], [
                'file.max' => 'The file must not be larger than 10MB',
                'file.mimetypes' => 'The file must be a pdf, powerpoint, or presentation document',
            ]);

            $this->filename = optional($this->file)->getClientOriginalName();
        }
    }

    /**
     * Downloads the available file
     * @return StreamedResponse|null
     */
    public function downloadFile(): ?StreamedResponse
    {
        $presentation = $this->presentation;

        if ($presentation && $presentation->file_path && $presentation->file_original_name) {
            return Storage::download($presentation->file_path, $presentation->file_original_name);
        }

        return null;
    }


    /**
     * Resets all things that could be updated in the form
     * @return void
     */
    public function cancel(): void
    {
        $this->form->resetPresentation();
        if ($this->presentation) {
            $this->form->setPresentation($this->presentation);
        }

        $this->file = null;
        $this->closeModal();
    }

    /**
     * Handles the joining as co-speaker of a presentation
     * @return void
     * @throws AuthorizationException
     */
    public function becomeSpeaker() : void
    {
        if ($this->presentation) {
            $this->authorize('joinAsCospeaker', $this->presentation);

            $this->user->joinPresentation($this->presentation, 'speaker');
            $this->dispatch('updated-dashboard');

            Toaster::success('Joined successfully as co-speaker of ' . $this->presentation->name . '.');

            $this->closeModal();
        }
    }

    /**
     * Sets the maximum width of the modal according to docs
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.modals.create-edit-presentation-modal');
    }
}

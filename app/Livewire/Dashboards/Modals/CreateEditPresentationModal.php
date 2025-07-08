<?php

namespace App\Livewire\Dashboards\Modals;

use App\Livewire\Forms\PresentationForm;
use App\Models\Difficulty;
use App\Models\Edition;
use App\Models\Presentation;
use App\Models\User;
use App\Traits\FileValidation;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CreateEditPresentationModal extends ModalComponent
{
    use WithFileUploads;
    use FileValidation;

    public PresentationForm $form;
    public Presentation $presentation;
    public User $user;
    public $file;
    public $presentationTypes;
    public $difficulties;
    public string $filename;

    /**
     * Initializes the component
     * @param User $user
     * @param int|null $presentationId
     * @return void
     */
    public function mount(User $user, ?int $presentationId) : void
    {
        $this->user = $user;
        $this->presentationTypes = optional(Edition::current())->presentationTypes;
        $this->difficulties = Difficulty::all();

        if ($presentationId) {
            $this->presentation = Presentation::find($presentationId);
            $this->form->setPresentation($this->presentation);
        }
    }

    /**
     * Saves the form
     * @return void
     */
    public function save() : void {
        $this->validate();

        if($this->presentation) {
            $this->authorize('update', $this->presentation);
            $this->form->update();

            if($this->file) {
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
                $path = $this->file->storeAs('presentations', explode('@',$this->user->email)[0] . '-presentation');
                $this->presentation->file_path = $path;
                $this->presentation->file_original_name = $this->file->getClientOriginalName();
                $this->presentation->save();
            }

            $this->presentation->refresh();
            Toaster::success("Presentation {$this->presentation->name} has been updated");
        } else {
            $this->authorize('request', Presentation::class);
            $this->form->create($this->user);
            Toaster::success("Presentation {$this->presentation->name} has been created");
        }

        $this->closeModal();
    }

    /**
     * Validates the uploaded file before showing the preview
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatedFile()
    {
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

        $this->filename = $this->file->getClientOriginalName();
    }

    /**
     * Downloads the available file
     * @return StreamedResponse
     */
    public function downloadFile()
    {
        return Storage::download($this->presentation->file_path, $this->presentation->file_original_name);
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

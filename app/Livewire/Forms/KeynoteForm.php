<?php

namespace App\Livewire\Forms;

use App\Models\Edition;
use App\Traits\FileValidation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class KeynoteForm extends Form
{
    use FileValidation;

    public $edition;

    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public $keynote_name;

    #[Validate(['required', 'string', 'min:3', 'max:700'])]
    public $keynote_description;

    public $keynote_photo_path;

    /**
     * Sets the edition's keynote speaker details per each field
     *
     * @param Edition $edition
     * @return void
     */
    public function setKeynote(Edition $edition)
    {
        $this->edition = $edition;

        $this->keynote_name = $edition->keynote_name;
        $this->keynote_description = $edition->keynote_description;
        $this->keynote_photo_path = $edition->keynote_photo_path;
    }

    /**
     * Updates the edition's keynote speaker details with the new data
     *
     * @return void
     */
    public function update()
    {
        if ($this->edition->keynote_photo_path != $this->keynote_photo_path) {
            $this->updateKeynotePhoto($this->keynote_photo_path);
        }

        $this->edition->update([
            'keynote_name' => $this->keynote_name,
            'keynote_description' => $this->keynote_description,
        ]);
    }

    /**
     * Updates photo of the keynote speaker
     *
     * @param UploadedFile $photo
     * @param string $storagePath
     * @return void
     */
    public function updateKeynotePhoto(UploadedFile $photo, string $storagePath = 'profile-photos'): void
    {
        $this->validateFileNameLength($this->keynote_photo_path, 'form.keynote_photo_path');

        $this->validate([
            'keynote_photo_path' => [
                'required',
                'image',
                'max:2048',
            ]
        ], [
            'keynote_photo_path.max' => 'The file must not be larger than 2MB',
        ]);

        $path = $this->keynote_photo_path->store('logos', 'public');

        $this->edition->update(['keynote_photo_path' => $path]);

        $this->reset(['keynote_photo_path']);
    }
}

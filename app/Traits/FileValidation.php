<?php

namespace App\Traits;

use enshrined\svgSanitize\Sanitizer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait FileValidation
{
    /**
     * This validates that the file has a name shorter than 250 chars
     * since files with longer names cannot be saved, therefore, do not
     * have extensions
     *
     * @param TemporaryUploadedFile $file
     * @param string $key
     * @return void
     * @throws ValidationException
     */
    protected function validateFileNameLength(TemporaryUploadedFile $file, string $key): void
    {
        if (empty($file->getClientOriginalExtension())) {
            $validator = Validator::make([], []);
            $validator->errors()->add($key, 'The file must have a name with less than 250 characters.');
            throw new ValidationException($validator);
        }
    }

    /**
     * Create a method that sanitizes svg files when uploaded
     * @param UploadedFile|TemporaryUploadedFile $file
     * @return string
     * @throws \Exception
     */
    public function sanitizeSvgFile(UploadedFile|TemporaryUploadedFile $file): string
    {
        $dirtySVG = file_get_contents($file->getRealPath());
        if ($dirtySVG === false) {
            throw new \Exception('File was unable to be parsed.');
        }

        $sanitizer = new Sanitizer();
        $cleanSVG = $sanitizer->sanitize($dirtySVG);

        if ($cleanSVG === false) {
            throw new \Exception('Invalid or unsafe SVG.');
        }

        return $cleanSVG;
    }
}

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
     * Checks if the svg file has a suspicious content
     * @param UploadedFile|TemporaryUploadedFile $file
     * @return bool
     * @throws \Exception
     */
    public function hasSuspiciousContent(UploadedFile|TemporaryUploadedFile $file): bool
    {
        $content = file_get_contents($file->getRealPath());
        if ($content === false) {
            throw new \Exception('File was unable to be parsed.');
        }

        $content = strtolower($content);
        $suspiciousPatterns = [
            '/<script\b[^>]*>/i', //Script tag
            '/on\w+="[^"]*"/i', //On[] event handler
            "/on\w+='[^']*'/i",
            '/xlink:href="javascript:/i', //js in href
            '/javascript:/i',
            '/<!\[CDATA\[.*?<\/script>/is'
        ];

        foreach ($suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                return true;
            }
        }

        return false;
    }
}

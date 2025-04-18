<?php

namespace Feature\Console;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Support\Facades\File;

class GenerateColoursSafelistTest extends TestCase
{
    protected string $safelistPath;

    protected function setUp(): void
    {
        parent::setUp();
        $this->safelistPath = base_path('tailwind.safelist.json');
        File::delete($this->safelistPath);
    }

    #[Test]
    public function test_that_it_generates_tailwind_safelist_json_file(): void
    {
        Config::set('colours', ['red', 'blue']);

        // Intercept the file write
        File::shouldReceive('put')
            ->once()
            ->withArgs(function ($path, $content) {
                $this->assertStringContainsString('tailwind.safelist.json', $path);

                $decoded = json_decode($content, true);
                $this->assertContains('bg-red-200', $decoded);
                $this->assertContains('text-blue-300', $decoded);
                $this->assertCount(8, $decoded);

                return true;
            });

        $exitCode = Artisan::call('tailwind:generate-colours-safelist');

        $this->assertEquals(0, $exitCode);
    }

    #[Test]
    public function test_that_it_outputs_success_message(): void
    {
        Config::set('colours', ['green']);

        File::shouldReceive('put')
            ->once()
            ->withArgs(function ($path, $content) {
                $data = json_decode($content, true);
                $this->assertCount(4, $data); // 4 classes for 1 colour
                return true;
            });

        $exitCode = Artisan::call('tailwind:generate-colours-safelist');

        $this->assertEquals(0, $exitCode);
        $this->assertStringContainsString(
            '✅ Safelist generated with 4 entries at:',
            Artisan::output()
        );
    }

    #[Test]
    public function test_that_it_fails_if_config_is_not_an_array(): void
    {
        Config::set('colours', 'not-an-array');

        File::shouldReceive('put')->never();

        $exitCode = Artisan::call('tailwind:generate-colours-safelist');

        $this->assertEquals(1, $exitCode);
        $this->assertStringContainsString(
            'config/colours.php must return an array.',
            Artisan::output()
        );
    }
}

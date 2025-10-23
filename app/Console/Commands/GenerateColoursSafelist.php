<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateColoursSafelist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tailwind:generate-colours-safelist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Tailwind CSS safelist from config/colors.php';

    /**
     * Execute the console command.
     */
    public function handle() : int
    {
        $colors = config('colours');

        if (!is_array($colors)) {
            $this->error('config/colours.php must return an array.');
            return 1;
        }

        $safelist = [];

        foreach ($colors as $color) {
            $safelist[] = "bg-{$color}-200";
            $safelist[] = "bg-{$color}-300";
            $safelist[] = "bg-{$color}-400";
            $safelist[] = "hover:bg-{$color}-700";
            $safelist[] = "border-{$color}-300";
            $safelist[] = "bg-{$color}-400/50";
            $safelist[] = "text-{$color}-300";
            $safelist[] = "from-{$color}-300";
            $safelist[] = "via-{$color}-400";
            $safelist[] = "to-{$color}-500";
        }

        $path = base_path('tailwind.safelist.json');
        $encoded = json_encode($safelist, JSON_PRETTY_PRINT);

        if ($encoded) {
            File::put($path, $encoded);
            $this->info("✅ Safelist generated with " . count($safelist) . " entries at: $path");
            return 0;
        }

        return 1;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Herbarium;
use App\Models\HerbariumImages;
use Illuminate\Console\Command;

class UpdateImageGenusId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-image-genus-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the genus_id column in the Images table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $images = HerbariumImages::all();

        foreach ($images as $image)
        {
            $this->line($image->herbarium_id);

            $herbarium = Herbarium::find($image->herbarium_id);

            if ($herbarium) {
                $this->line('Genus id is '.$herbarium->genus_id);
                $image->update(['genus_id'=>$herbarium->genus_id]);
            }
        }
    }
}

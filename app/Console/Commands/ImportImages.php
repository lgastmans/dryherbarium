<?php

namespace App\Console\Commands;

use App\Models\HerbariumImages;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Herbarium images from CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = public_path('HerbariumImages.csv');
        $dataArr = $this->csvToArray($file, "|");
        //$this->line($dataArr);
        //print_r($dataArr);die();

        $count = count($dataArr);
        
        for ($i = 0; $i < $count; $i ++)
        {
            $this->line(print_r($dataArr[$i]));
            $row = HerbariumImages::insert($dataArr[$i]);
        }

        $this->line($this->description.' complete.');
    }

    /*
        convert the csv file to array
    */
    private static function csvToArray($filename = '', $delimiter = "\t")
    {
        if (!file_exists($filename) || !is_readable($filename))
            return 'File not found '.$filename;

        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            $i=0;
            while (($row = fgetcsv($handle, 0, $delimiter)) !== false)
            {
                if ((empty($row[0])) || (is_null($row[0])))
                    $data[$i]['id'] = $i;
                else
                    $data[$i]['id'] = $row[0];

                if ((empty($row[1])) || (is_null($row[1])))
                    $data[$i]['herbarium_id'] = $i;
                else
                    $data[$i]['herbarium_id'] = $row[1];                

                $data[$i]['filename'] = 'image_'.$row[0].'_'.$row[1].'.jpg';                

                $i++;
            }
            fclose($handle);
        }
        return $data;
    }

}

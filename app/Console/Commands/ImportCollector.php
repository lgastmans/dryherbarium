<?php

namespace App\Console\Commands;

use App\Models\Collector;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportCollector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-collector';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Herbarium collectors from CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
            File columns in order in CSV | corresponding column name:
            
                id  
                name
                surname
        */

        $file = public_path('Collector.csv');
        $dataArr = $this->csvToArray($file, "|");
        //print_r($dataArr);die();

        for ($i = 0; $i < count($dataArr); $i ++)
        {
            $row = Collector::insert($dataArr[$i]);
        }

        return 'Import complete';
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
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {

                if ((empty($row[0])) || (is_null($row[0])))
                    $data[$i]['id'] = $i;
                else
                    $data[$i]['id'] = $row[0];

                if ((empty($row[1])) || (is_null($row[1])))
                    $data[$i]['name'] = "name".$i;
                else
                    $data[$i]['name'] = $row[1];

                if ((empty($row[2])) || (is_null($row[2])))
                    $data[$i]['surname'] = null;
                else
                    $data[$i]['surname'] = $row[2];

                $i++;
            }
            fclose($handle);
        }

        return $data;
    }       
}

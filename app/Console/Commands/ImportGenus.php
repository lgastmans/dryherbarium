<?php

namespace App\Console\Commands;

use App\Models\Genus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportGenus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-genus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Herbarium genus from CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
            File columns in order in CSV | corresponding column name:
            
                id  
                genus
        */

        $file = public_path('Genus.csv');
        $dataArr = $this->csvToArray($file, "|");
        //print_r($dataArr);die();


        $count = count($dataArr);
        
        for ($i = 0; $i < $count; $i ++)
        {
            $row = Genus::insert($dataArr[$i]);
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
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {

                if ((empty($row[0])) || (is_null($row[0])))
                    $data[$i]['id'] = $i;
                else
                    $data[$i]['id'] = $row[0];

                if ((empty($row[1])) || (is_null($row[1])))
                    $data[$i]['name'] = "name".$i;
                else {
                    if ((strlen($row[1]) > 0) && ($row[1][0] === "'"))
                        $data[$i]['name'] = rtrim(substr($row[1], 1),"'");
                    else
                        $data[$i]['name'] = $row[1];
                }

                $i++;
            }
            fclose($handle);
        }

        return $data;
    }

}

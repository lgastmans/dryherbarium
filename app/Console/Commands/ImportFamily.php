<?php

namespace App\Console\Commands;

use App\Models\Family;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportFamily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-family';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Herbarium families from CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
            File columns in order in CSV | corresponding column name:
            
                id  
                family
        */

        $file = public_path('Family.csv');
        $dataArr = $this->csvToArray($file, "|");

        for ($i = 0; $i < count($dataArr); $i ++)
        {
            /*
            $row = Family::where('family', 'like', '%'.$dataArr[$i]['state_id'].'%')->first();

            if ($row)
                $dataArr[$i]['state_id'] = $row->id;
            else
                $dataArr[$i]['state_id'] = 1;
            */
            $row = Family::insert($dataArr[$i]);
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
                    $data[$i]['family'] = $i;
                else
                    $data[$i]['family'] = $row[1];

                $i++;
            }
            fclose($handle);
        }

        return $data;
    }    

}

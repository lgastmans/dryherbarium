<?php

namespace App\Console\Commands;

use App\Models\Herbarium;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportHerbarium extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-herbarium';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Herbarium data from CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
            File columns in order in CSV | corresponding column name:
            
                id  
                
        */

        $file = public_path('Herbarium.csv');
        $dataArr = $this->csvToArray($file, "|");
        //print_r($dataArr);die();

        $count = count($dataArr);
        
        for ($i = 0; $i < $count; $i ++)
        {
            $this->line(print_r($dataArr[$i]));
            $row = Herbarium::insert($dataArr[$i]);
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
            //while($line=fgets($fp,65535)) {
            while (($row = fgetcsv($handle, 0, $delimiter)) !== false)
            {
                //$this->line($row);

                if ((empty($row[0])) || (is_null($row[0])))
                    $data[$i]['id'] = $i;
                else
                    $data[$i]['id'] = $row[0];

                if ((empty($row[1])) || (is_null($row[1])) || ($row[1]==-1))
                    $data[$i]['family_id'] = 0;
                else
                    $data[$i]['family_id'] = $row[1];

                if ((empty($row[2])) || (is_null($row[2])) || ($row[2]==-1))
                    $data[$i]['place_id'] = 0;
                else
                    $data[$i]['place_id'] = $row[2];

                if ((empty($row[3])) || (is_null($row[3])) || ($row[3]==-1))
                    $data[$i]['taluk_id'] = 0;
                else
                    $data[$i]['taluk_id'] = $row[3];

                if ((empty($row[4])) || (is_null($row[4])) || ($row[4]==-1))
                    $data[$i]['district_id'] = 0;
                else
                    $data[$i]['district_id'] = $row[4];

                if ((empty($row[5])) || (is_null($row[5])) || ($row[5]==-1))
                    $data[$i]['state_id'] = 0;
                else
                    $data[$i]['state_id'] = $row[5];

                if ((empty($row[6])) || (is_null($row[6])) || ($row[6]==-1))
                    $data[$i]['genus_id'] = 0;
                else
                    $data[$i]['genus_id'] = $row[6];

                if ((empty($row[7])) || (is_null($row[7])) || ($row[7]==-1))
                    $data[$i]['status_id'] = 0;
                else
                    $data[$i]['status_id'] = $row[7];

                if ((empty($row[8])) || (is_null($row[8])) || ($row[8]==-1))
                    $data[$i]['collector1_id'] = 0;
                else
                    $data[$i]['collector1_id'] = $row[8];

                if ((empty($row[9])) || (is_null($row[9])) || ($row[9]==-1))
                    $data[$i]['collector2_id'] = 0;
                else
                    $data[$i]['collector2_id'] = $row[9];

                if ((empty($row[10])) || (is_null($row[10])) || ($row[10]==-1))
                    $data[$i]['collector3_id'] = 0;
                else
                    $data[$i]['collector3_id'] = $row[10];

                if ((empty($row[11])) || (is_null($row[11])) || ($row[11]==-1))
                    $data[$i]['collector4_id'] = 0;
                else
                    $data[$i]['collector4_id'] = $row[11];


                $r = 12;


                if ((empty($row[$r])) || (is_null($row[$r])) || ($row[$r]==-1))
                    $data[$i]['specific_id'] = 0;
                else
                    $data[$i]['specific_id'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['collection_number'] = '';
                else
                    $data[$i]['collection_number'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['vernacular_name'] = '';
                else
                    $data[$i]['vernacular_name'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['quantity_main'] = 0;
                else
                    $data[$i]['quantity_main'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['quantity_duplicate'] = 0;
                else
                    $data[$i]['quantity_duplicate'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['quantity_lent'] = '';
                else
                    $data[$i]['quantity_lent'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['notes'] = '';
                else
                    $data[$i]['notes'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['collected_on'] = '';
                else
                    $data[$i]['collected_on'] = date('Y-m-d', strtotime($row[$r]));

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['herbarium_number'] = '';
                else
                    $data[$i]['herbarium_number'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['latitude'] = '';
                else {
                    $str = str_replace("?", "°", $row[$r]);
                    $data[$i]['latitude'] = substr(str_replace('"', '', $str), 1, -1);
                }

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['longitude'] = '';
                else {
                    $str = str_replace("?", "°", $row[$r]);
                    $data[$i]['longitude'] = substr(str_replace('"', '', $str), 1, -1);
                }

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['altitude'] = '';
                else
                    $data[$i]['altitude'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['habit'] = '';
                else
                    $data[$i]['habit'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['description'] = '';
                else
                    $data[$i]['description'] = str_replace(array("'", "\n", "\t", "\r"), '', $row[$r]);

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['association'] = '';
                else
                    $data[$i]['association'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['frequency'] = '';
                else
                    $data[$i]['frequency'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['micro_habitat'] = '';
                else
                    $data[$i]['micro_habitat'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['leaf'] = '';
                else
                    $data[$i]['leaf'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['phenology'] = '';
                else
                    $data[$i]['phenology'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['flower'] = '';
                else
                    $data[$i]['flower'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['fruit'] = '';
                else
                    $data[$i]['fruit'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['seeds'] = '';
                else
                    $data[$i]['seeds'] = $row[$r];

                $r++;
                if ((empty($row[$r])) || (is_null($row[$r])))
                    $data[$i]['forest'] = '';
                else
                    $data[$i]['forest'] = $row[$r];

                $i++;
            }
            fclose($handle);
        }

        return $data;
    }

}

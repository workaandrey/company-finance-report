<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [];
        if (($handle = fopen(resource_path() . '/companylist.csv', "r")) !== FALSE) {
            $i = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($i > 0) {
                    $rows[$data[0]] =[
                        'symbol' => $data[0],
                        'name' => $data[1]
                    ];
                }
                $i++;
            }
            fclose($handle);
        }

        foreach(array_chunk($rows, 10) as $chunk) {
            DB::table('companies')->insert($chunk);
        }
    }
}

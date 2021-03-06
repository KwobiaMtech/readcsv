<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

function getNetwork($number){
    $mno_array = array(
        0 => array("name" => "NONE", "regex" => ""),
        1 => array("name" => "GLOBACOMM", "regex" => "^(\+?)(0|233)?(23)"),
        2 => array("name" => "AIRTEL", "regex" => "^(\+?)(0|233)?(26)"),
        3 => array("name" => "MTN", "regex" => "^(\+?)(0|233)?(24|54|55|59)"),
        4 => array("name" => "TIGO", "regex" => "^(\+?)(0|233)?(27|57)"),
        5 => array("name" => "expresso", "regex" => "^(\+?)(0|233)?(28)"),
        6 => array("name" => "VODAFONE", "regex" => "^(\+?)(0|233)?(20|50)")
    );

    foreach ($mno_array as $key => $value) {
        if (preg_match("/" . $value['regex'] . "/", trim($number))) {
            $mno = @array("id" => $key, "name" => $value['name']);
        }
    }

    if (empty($mno)) {
        $mno = array("id" => 0, "name" => "NONE");

    }
    return $mno['name'];

}

Route::get('/', function () {

    $the_big_array = [];
    $filename = public_path('svoda.csv');
    $count = 0;

    if (($h = fopen("{$filename}", "r")) !== FALSE)
    {

        while (($data = fgetcsv($h, 1000, ",")) !== FALSE)
        {

            $the_big_array[] = $data;

        }
        fclose($h);
    }
$counter = 0;
foreach ($the_big_array as $item){
    if(!empty($item[0])){
        $network = getNetwork($item[0]);
        if($network == 'VODAFONE'){
            $counter ++;
            var_dump($item[0]);
        }

    }


}
    var_dump("Counter");
    var_dump($counter);
  // return view('welcome');
});

<?php

require_once 'vendor/autoload.php';
use prymag\SimpleCSV\CSVReader;
$v = new CSVReader( 'Test.csv', true );

$arr = $v->read()->getData();
//var_dump($arr);

foreach($arr as $a){
    echo $a['Year'] . "\n";
}
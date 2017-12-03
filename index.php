<?php

require_once 'vendor/autoload.php';
use prymag\SimpleCSV\CSVReader;

$csv = new CSVReader( 'Sample.csv', true );

$array = $csv->read()->getData();

foreach($array as $item){
    if( is_array($item) ){
        foreach($item as $key => $val){
            echo $key . ' : ' . $val . '<br/>';
        }
    }
    else {
        echo 'Invalid';
    }
    echo '<hr/>';
}
echo 'Total' . $v->getTotal();
<?php

require_once 'vendor/autoload.php';

use prymag\SimpleCSV\CSVWriter;

if( isset($_POST['download']) ){
    $headers = array('Country', 'Language', 'Capital', 'Currency');
    $data = array(
        array('Philippines', 'Filipino', 'Manila', 'PHP'),
        array('South Korea', 'Hangul', 'Seoul', 'KRW'),
        array('Singapore', 'English', 'Singapore', 'SGD'),
        array('Australia', 'English', 'Sydney', 'AUD'),
        array('New Zealand', 'English', 'Auckland', 'NZD'),
    );

    $writer = new CSVWriter( $data );
    $writer->setHeaders( $headers )->download();
    die();
}
if( isset($_POST['display']) ){
    $data2 = array (
        array('Country' => 'Philippines', 'Language' => 'Filipino', 'Capital' => 'Manila', 'Currency' => 'PHP'),
        array('Country' => 'South Korea', 'Language' => 'Hangul', 'Capital' => 'Seoul', 'Currency' => 'KRW'),
        array('Country' => 'Singapore', 'Language' => 'English', 'Capital' => 'Singapore', 'Currency' => 'SGD'),
        array('Country' => 'Australia', 'Language' => 'English', 'Capital' => 'Sydney', 'Currency' => 'AUD'),
        array('Country' => 'New Zealand', 'Language' => 'English', 'Capital' => 'Auckland', 'Currency' => 'NZD'),
    );
    $writer = new CSVWriter( $data2 );
    $writer->download();
    die();
}

?>

<html>
<head>
<body>
    <form action="" method="post">
        <button type="submit" value="download" name="download">Download</button>
        <button type="submit" value="download" name="display">Display</button>
    </form>
</body>
</head>
</html>
<?php

use \prymag\SimpleCSV\CSVReader;

class CSVReaderTest extends \PHPUnit\Framework\TestCase {

    public function testReaderParsesCSV(){

        $reader = new CSVReader('Sample.csv');
        $data = $reader->read()->getData();
        $this->assertTrue(is_array($data));

    }
    
    /**
     * @expectedException     Exception
     */
    public function testReaderThrowsException(){
        $reader = new CSVReader('invalid file.csv');
        $data = $reader->validateFile();
    }
    
}
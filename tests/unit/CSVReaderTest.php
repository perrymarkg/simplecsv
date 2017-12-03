<?php

use \prymag\SimpleCSV\CSVReader;

class CSVReaderTest extends \PHPUnit\Framework\TestCase {

    private $reader;
    private $data;
    private $total;

    public function setUp(){
        $this->reader = new CSVReader('Sample.csv', true);
        $this->data = $this->reader->read()->getData();
        $this->total = $this->reader->getTotal();
    }

    public function testReaderParsesCSV(){

        $this->assertTrue(is_array($this->data));

    }

    public function testCSVDataNotEmpty(){
        
        $this->assertTrue( !empty($this->data) );
    }
    
    public function testCheckCount(){
        $this->assertEquals( 9, $this->total);
    }

    
    
}
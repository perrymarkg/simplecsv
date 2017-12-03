<?php

namespace prymag\SimpleCSV;

/**
 * CSVReader for reading a csv file and parsing it to an array
 */
class CSVReader {

    private $file;
    private $hasHeaders;
    private $data;
    private $total;

    /**
     * Options for the class
     *  delimiter = The delimiter used on the csv file
     * @var array
     */
    private $options = array('delimiter' => ',');
    
    /**
     * Class constructor
     *
     * @param boolean $file = filename
     * @param boolean $hasHeaders = true if you want to use the headers as array key for the result
     * @param array $options = pass additional options to be imrpoved
     */
    public function __construct( $file = false, $hasHeaders = false, $options = array()){

        $this->file = $file;
        $this->hasHeaders = $hasHeaders;
        is_array($options) ? $this->options = array_merge($this->options, $options) : ''; 

        return $this;
    }

    /**
     * Validate if CSV file exists
     *
     * @return void
     */
    public function validateFile(){
        if( !file_exists($this->file) ){
            throw new \Exception('CSV File does not exists!');
        }
    }

    /**
     * Read contents of the CSV File
     *
     * @return void
     */
    public function read(){
        
        try{
            $this->validateFile();
        }
        catch( \Exception $e){
            return 'File does not exist!';
        }

        $handle = fopen( $this->file, 'r' );
        
        $ctr = 0;
        while( ($row = fgetcsv($handle, 0, $this->options['delimiter']) ) !== FALSE ){
            if( $this->hasHeaders && $ctr == 0 ){
                $headers = $row;
            }
            else{
                foreach( $row as $k => $v ){           
                    $item[ $headers[$k] ] = $v;
                }
                $this->data[] = $item;
            }
            $ctr++;
        }
        fclose($handle);

        $this->total = $ctr;
        return $this;
    }

    /**
     * Get the CSV data
     *
     */
    public function getData(){
        return $this->data;
    }

    /**
     * Get total data processed
     *
     * @return void
     */
    public function getTotal(){
        return $this->hasHeaders ? $this->total-1 : $this->total;
    }

}
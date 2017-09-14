<?php

namespace prymag\SimpleCSV;

class CSVReader {

    private $file;
    private $hasHeaders;
    private $data;
    private $total;

    private $options = array('delimiter' => ',');

    public function __construct( $file = false, $hasHeaders = false, $options = false){

        $this->file = $file;
        $this->hasHeaders = $hasHeaders;
        is_array($options) ? $this->options = array_merge($this->options, $options) : ''; 

        try{
            $this->validateFile();
        }
        catch( \Exception $e){
            die( 'Error:' . $e->getMessage() );
        }

        return $this;
    }

    public function validateFile(){
        if( !file_exists($this->file) ){
            throw new \Exception('CSV File does not exists!');
        }
    }

    public function read(){
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

    public function getData(){
        return $this->data;
    }

    public function getTotal(){
        return $total;
    }

}
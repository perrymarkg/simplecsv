<?php

namespace prymag\SimpleCSV;

class CSVWriter {

    private $headers = array();
    private $fp;
    private $data;
    private $filename = 'csvfile';

    function __construct( $data ){
        $this->data = $data;
    }

    function setHeaders( $headers ){
        $this->headers = $headers;
        return $this;
    }

    function setFileName( $filename ){
        $this->filename = $filename;
        return $this;
    }

    private function assignHeaders(){
        if( !isset($this->fp) )
            throw new \Exception('Error setting header');

        if( !empty($this->headers) ){
            fputcsv($this->fp, $this->headers);
        }
        else {
            $keys = array_keys( $this->data[0] );
            if( !empty( $keys ) )
                fputcsv($this->fp, $keys);
        }

        return $this;
            
    }

    function download(){

        $this->fp = fopen('php://output', 'w');
        $this->assignHeaders();

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename={$this->filename}.csv");
        
        foreach($this->data as $d){
            fputcsv($this->fp, $d);
        }
        fclose($this->fp);
    }

    function write($filename, $file, $type){
        
        $this->fp = fopen($filename, 'w');
        
        fclose($this->fp);

    }



}
<?php

namespace prymag\SimpleCSV;

/**
 * CSVWriter for writing to a CSV file or creating CSV file for download from array
 */
class CSVWriter {

    private $headers;
    private $fp; // File obj
    private $data;
    private $filename = 'csvfile'; // default filename for download

    /**
     * Class constructor
     *
     * @param array $data
     */
    function __construct( $data = array() ){
        $this->data = $data;
    }

    /**
     * Set the headers for the CSV file
     *
     * @param array $headers
     * @return void
     */
    function setHeaders( $headers = array()){
        $this->headers = $headers;
        return $this;
    }

    /**
     * Set the CSV filename for download
     *
     * @param string $filename
     * @return void
     */
    function setFileName( $filename ){
        $this->filename = $filename;
        return $this;
    }

    /**
     * Assigns the correct row headers for the CSV file
     *
     * @return void
     */
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

    /**
     * Download the CSV file
     *
     * @return void
     */
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

    /**
     * Append the data to the CSV file
     *
     * @param [type] $filename
     * @return void
     */
    function write($filename){
        
        $this->fp = fopen($filename, 'a+');
        
        foreach($this->data as $d){
            fputcsv($this->fp, $d);
        }
        fclose($this->fp);

    }



}
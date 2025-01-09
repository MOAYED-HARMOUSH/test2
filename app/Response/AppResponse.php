<?php
namespace App\Response;
class AppResponse {

    public $data=null;
    public int $status =200 ;
    public string $error ='' ;

    public function __construct($returnData,$returnStatus=200,$returError='')
    {
        $this->data=$returnData;
        
        $this->status=$returnStatus;
        
        $this->error=$returError;
        
    }

    
}
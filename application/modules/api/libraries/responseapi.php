<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResponseAPI{
    
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
    }
    
    public function DataToReponse($responseArray, $dataRequest){
        
        $this->CI->load->response($dataRequest['response']);
        $keysReturn = get_object_vars ( $this->CI->$dataRequest['response'] );
        $responseArray = array_change_key_case($responseArray, CASE_LOWER);
        return array_intersect_key($responseArray, $keysReturn);
        
    }
    
}
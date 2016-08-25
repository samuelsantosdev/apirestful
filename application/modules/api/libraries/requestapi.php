<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RequestAPI{
    
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
    }
    
    public function IsValid( $data, $method, $class ){
        $requestParams = $this->getInfos($class, $method);
        if($_SERVER["REQUEST_METHOD"] != strtoupper($requestParams['method']))
            throw new Exception("Method Not Allowed", 405);
        
        if($this->CompareRequest($data, $requestParams['request']) == FALSE || empty($data))
            throw new Exception("Bad Request", 400);
        
        return TRUE;
    }
    
    private function CompareRequest($data, $class){
        $this->CI->load->request($class);
        $arrayProp = get_object_vars ( $this->CI->$class );
        return count(array_diff(array_keys($data), $arrayProp)) == 0;                
    }
    
    private function GetInfos($class, $method) {
        try{
            $path_class = APPPATH . "modules/api/controllers/{$class}.php";
            $reflector = new ReflectionClass($class);
            $annot = $reflector->getMethod($method)->getDocComment();            
            if(empty($annot))
                return null;
            
            $annotations = explode(PHP_EOL, str_replace(array("/", "*", " "), "", $annot));
            foreach ($annotations as $line){
                if(empty($line))
                    continue;
                $datas = explode("=", $line);
                $annotationsArray[$datas[0]] = $datas[1];
            }
            
            return $annotationsArray;
        }
        catch(Exception $ex){
            error_log("ERROR:" . $ex->getMessage());            
        }
        return null;
    }
        
        
}

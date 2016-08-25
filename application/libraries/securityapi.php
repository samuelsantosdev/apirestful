<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Securityapi{
    
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
    }
    
    private function IsRoot($accountId){
        $result = $this->CI->db->get_where("Account", array("Id"=>$accountId));
        $userDb = $result->row();
        return $userDb->Root;
    }
    
    public function IsAllowed( $accountId, $method, $class ){
        
        if($this->IsRoot($accountId))
            return TRUE;
        
        $result = $this->CI->db->get_where("AccountMethod", array("AccountId"=>$accountId, 'Method'=>$class."/".$method));
        if(count($result->result()) == 0)
            throw new Exception ("Permission Denied", 403);
    }
}

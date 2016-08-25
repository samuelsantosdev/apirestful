<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerServices{
    
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
    }
    
    public function CreateAccount($email, $senha){
        $secret = trim(com_create_guid(), '{}');
        $apikey = MD5(trim(com_create_guid(), '{}'));
        $data = array(
            'Email'=>$email, 
            "Pass" => PassEncript( $email, $senha), 
            'SecretKey'=> $secret, 
            'ApiKey' => $apikey,
            'Active'=>1);
        
        if($this->CI->db->insert("Account", $data ))
            return $data;
        
        return false;
    }
    
    public function Auth($apikey, $secretkey){
        $customer = $this->CI->db->get_where("Account", array('SecretKey'=>$secretkey, 'ApiKey'=>$apikey));
        if(empty($customer))
            throw new Exception ("Customer not exists", 404);
        
        return $customer->row();
    }
    
    private function Validate(){
        
    }
    
}

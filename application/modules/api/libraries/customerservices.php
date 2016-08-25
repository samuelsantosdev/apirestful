<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerServices{
    
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
    }
    
    public function CreateAccount($email, $pass){
        
        $this->Validate($email, $pass);
        
        $secret = trim(com_create_guid(), '{}');
        $apikey = MD5(trim(com_create_guid(), '{}'));
        $data = array(
            'Email'=>$email, 
            "Pass" => PassEncript( $email, $pass), 
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
    
    public function GetAllMethods($accountId){
        $methods = $this->CI->db->get_where("AccountMethod", array('AccountId'=>$accountId));
        return $methods->result();
    }
    
    public function GetAllAccounts($where){
        $accounts = $this->CI->db->get_where("Account", $where);
        return $accounts->result();
    }
    
    public function GetAccount($id){
        $accounts = $this->CI->db->get_where("Account", array("Id"=>$id));
        $rowDB = $accounts->row();
        if($rowDB == null)
            throw new Exception ("Account not exists", 404);
        
        return array(
            'Email' => $rowDB->Email, 
            'SecretKey'=> $rowDB->SecretKey, 
            'ApiKey' => $rowDB->ApiKey,
            'Active'=>$rowDB->Active);
    }
    
    public function UpdateAccount($data){
        unset($data['token']);
        if($this->CI->db->update( "Account", $data, array("Id" => $data['id']) ))
           return $data;
        
        throw new Exception ("Update not found", 500);      
    }
    
    public function DeleteAccount($id){
        if($this->CI->db->update( "Account", array("Removed"=>true), array("Id" => $id) ))
           return TRUE;
        
        throw new Exception ("Delete not found", 500);      
    }
    
    private function Validate($email, $pass){
        if(strlen($pass) < 4)
            throw new Exception ("Password required four characteres or more", 400);
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new Exception ("Invalid email", 400);        
    }
    
}

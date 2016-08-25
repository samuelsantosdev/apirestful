<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TokenServices{
    
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
    }
    
    private function RefreshedToken($tokenDb){
        $time = strtotime($tokenDb->LastActivity);
        $endTime = date("Y-m-d H:i:s", strtotime('+5 minutes', $time));
        if($endTime <= date("Y-m-d H:i:s")){
            throw new Exception ("Token Expired, refresh your token", 403);
        }
    }
    
    private function ExpiredToken($tokenDb){
        $time = strtotime($tokenDb->LastActivity);
        $endTime = date("Y-m-d H:i:s", strtotime('+15 minutes', $time));
        if($endTime <= date("Y-m-d H:i:s")){
            $this->CI->db->update("Token", array("Active"=>false), array("Id" => $tokenDb->Id) );
            throw new Exception ("RefreshToken Expired", 403);
        }        
    }
    
    public function RefreshToken($refresh){
        $tokenDb = $this->CI->db->get_where("Token", array("Active"=>1, "RefreshToken"=>$refresh));
        if($tokenDb->row() != null){
            $tokenRow = $tokenDb->row();
            
            $this->ExpiredToken($tokenRow);
                
            $token = trim(com_create_guid(), '{}');
            $this->CI->db->update("Token", array("Token"=>$token), array("Id" => $tokenRow->Id) );
            
            return array(
                    'Token'=>$token,
                    "RefreshToken" => $refresh, 
                    'LastActivity'=> date("Y-m-d H:i:s"),
                );
        }
        return FALSE;
    }
    
    public function ValidToken($token = null){
        if(empty($token))
            throw new Exception ("Invalid Token", 403);
        
        $tokenDb = $this->CI->db->get_where("Token", array("Active"=>1, "Token"=>$token));
        if($tokenDb->row() != null){
            $tokenRow = $tokenDb->row();
            
            $this->ExpiredToken($tokenRow);
            $this->RefreshedToken($tokenRow);
            
            return $tokenRow->AccountId;            
        }
        throw new Exception ("Invalid Token", 403);
    }
    
    public function CreateToken($accountId){
        
        $tokenDb = $this->CI->db->get_where("Token", array("AccountId"=>$accountId, "Active"=>1));
        if($tokenDb->row() != null){
            $tokenRow = $tokenDb->row();
            $this->CI->db->update("Token", array("Active"=>false), array("Id" => $tokenRow->Id) );
        }
        
        $token = trim(com_create_guid(), '{}');
        $refreshToken = MD5(trim(com_create_guid(), '{}'));
        $data = array(
            'Token'=>$token, 
            "RefreshToken" => $refreshToken, 
            'LastActivity'=> date("Y-m-d H:i:s"),
            'AccountId'=>$accountId,
            'Active'=>1);
                
        if($this->CI->db->insert("Token", $data ))
            return $data;
                
        return false;
    }
}
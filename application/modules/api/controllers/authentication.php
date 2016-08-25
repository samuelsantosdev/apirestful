<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends MX_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('requestapi');
        $this->load->library('responseapi');
    }
    
    /**
     * method=post
     * request=auth
     * response=token
     */
    public function GetToken(){
        try{
            if ( $this->requestapi->IsValid( $this->input->post(), $this->router->fetch_method(), get_class() ) ){
                $this->load->library("customerservices");
                $customerData = $this->customerservices->Auth($this->input->post("apikey"), $this->input->post("secretkey"));
                
                $this->load->library("tokenservices");
                $token = $data = $this->tokenservices->CreateToken($customerData->Id);                
                $responseArray = $this->responseapi->DataToReponse($token, $this->requestapi->DataRequest());
                $this->output($responseArray);
            }
        } catch (Exception $ex) {
            $this->output_error($ex);
        }
    }
    
    /**
     * method=post
     * request=refreshtoken
     * response=token
     */
    public function RefreshToken(){
        try{
            if ( $this->requestapi->IsValid( $this->input->post(), $this->router->fetch_method(), get_class() ) ){
                
                $this->load->library("tokenservices");
                $token = $data = $this->tokenservices->RefreshToken($this->input->post("refreshtoken"));
                $responseArray = $this->responseapi->DataToReponse($token, $this->requestapi->DataRequest());
                
                $this->output($responseArray);
            }
        } catch (Exception $ex) {
            $this->output_error($ex);
        }
    }
}
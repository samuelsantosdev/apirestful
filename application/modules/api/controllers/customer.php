<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MX_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('requestapi');
        $this->load->library('responseapi');
    }
    
    /**
     * method=post
     * request=createaccount
     * response=account
     */
    public function CreateAccount(){
        try{
            $accountId = $this->tokenservices->ValidToken($this->input->post("token"));
            if ( $this->requestapi->IsValid( $this->input->post(), $this->router->fetch_method(), get_class() ) ){
                $this->load->library("customerservices");
                $responseArray = $this->customerservices->CreateAccount($this->input->post("email"), $this->input->post("senha"));
                $responseArray = $this->responseapi->DataToReponse($responseArray, $this->requestapi->DataRequest());
                $this->output($responseArray);
            }
        } catch (Exception $ex) {
            $this->output_error($ex);
        }
    }
}

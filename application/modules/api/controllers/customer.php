<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MX_Controller{
    
    function __construct() {
        parent::__construct();
        header('Content-Type: application/json');
        $this->load->library('requestapi');
    }
    
    /**
     * method=get
     * request=createaccount
     * response=account
     */
    public function CreateAccount(){
        try{
            if ( $this->requestapi->IsValid( $this->input->post(), $this->router->fetch_method(), get_class() ) ){
                
            }
        } catch (Exception $ex) {
            $this->output->set_output(json_encode(array('code'=>$ex->getCode(), 'message'=>'Internal Server Error: '.$ex->getMessage())));
        }               
    }
}

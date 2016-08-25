<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MX_Controller{
    
    private $accountId;
    
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
    
    /**
     * method=get
     * response=accounts
     */
    public function GetAccounts(){
        try{
            $this->accountId = $this->tokenservices->ValidToken($this->input->post("token"));
            $this->securityapi->IsAllowed( $this->accountId, $this->router->fetch_method(), get_class() );
            if ( $this->requestapi->IsValid( $this->input->get(), $this->router->fetch_method(), get_class() ) ){
                $this->load->library("customerservices");
                $responseArray = $this->customerservices->CreateAccount($this->input->post("email"), $this->input->post("senha"));
                $responseArray = $this->responseapi->DataToReponse($responseArray, $this->requestapi->DataRequest());
                $this->output($responseArray);
            }
        } catch (Exception $ex) {
            $this->output_error($ex);
        }
    }
    
    /**
     * method=get
     * response=account
     */
    public function GetAccount($id){
        try{
            $this->accountId = $this->tokenservices->ValidToken($this->input->post("token"));
            $this->securityapi->IsAllowed( $this->accountId, $this->router->fetch_method(), get_class() );
            if ( $this->requestapi->IsValid( $this->input->get(), $this->router->fetch_method(), get_class() ) ){
                $this->load->library("customerservices");
                $responseArray = $this->customerservices->CreateAccount($this->input->post("email"), $this->input->post("senha"));
                $responseArray = $this->responseapi->DataToReponse($responseArray, $this->requestapi->DataRequest());
                $this->output($responseArray);
            }
        } catch (Exception $ex) {
            $this->output_error($ex);
        }
    }
    
    /**
     * method=put
     * response=updateaccount
     */
    public function UpdateAccount(){
        try{
            $this->accountId = $this->tokenservices->ValidToken($this->input->post("token"));
            $this->securityapi->IsAllowed( $this->accountId, $this->router->fetch_method(), get_class() );
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
    
    /**
     * method=delete
     * response=deleteaccount
     */
    public function DeleteAccount(){
        try{
            $this->accountId = $this->tokenservices->ValidToken($this->input->post("token"));
            $this->securityapi->IsAllowed( $this->accountId, $this->router->fetch_method(), get_class() );
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

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
                $responseArray = $this->customerservices->CreateAccount($this->input->post("email"), $this->input->post("pass"));
                $responseArray = $this->responseapi->DataToReponse($responseArray, $this->requestapi->DataRequest());
                $this->output($responseArray);
            }
        } catch (Exception $ex) {
            $this->output_error($ex);
        }
    }
    
    /**
     * method=get
     * request=token
     * response=methods
     */
    public function Lookup(){
        try{
            $this->accountId = $this->tokenservices->ValidToken($this->input->get("token"));
            if ( $this->requestapi->IsValid( $this->input->get(), $this->router->fetch_method(), get_class() ) ){
                $this->load->library("customerservices");
                $responseArray = $this->customerservices->GetAllMethods($this->accountId);
                $responseArray = $this->responseapi->DataToReponseList($responseArray, $this->requestapi->DataRequest());
                $this->output($responseArray);
            }
        } catch (Exception $ex) {
            $this->output_error($ex);
        }
    }
    
    /**
     * method=get
     * request=token
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
     * request=token
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
     * request=updateaccount
     * response=reponsemessage
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
     * request=deleteaccount
     * response=reponsemessage
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

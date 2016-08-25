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
     * response=account
     */
    public function GetAccounts(){
        try{
            $this->accountId = $this->tokenservices->ValidToken($this->input->get("token"));
            $this->securityapi->IsAllowed( $this->accountId, $this->router->fetch_method(), get_class() );
            if ( $this->requestapi->IsValid( $this->input->get(), $this->router->fetch_method(), get_class() ) ){
                $this->load->library("customerservices");
                $responseArray = $this->customerservices->GetAllAccounts(array("Removed"=>false));
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
     * response=account
     */
    public function GetAccountsDeleted(){
        try{
            $this->accountId = $this->tokenservices->ValidToken($this->input->get("token"));
            $this->securityapi->IsAllowed( $this->accountId, $this->router->fetch_method(), get_class() );
            if ( $this->requestapi->IsValid( $this->input->get(), $this->router->fetch_method(), get_class() ) ){
                $this->load->library("customerservices");
                $responseArray = $this->customerservices->GetAllAccounts(array("Removed"=>true));
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
     * response=account
     */
    public function GetAccount(){
        try{
            $this->accountId = $this->tokenservices->ValidToken($this->input->get("token"));
            $this->securityapi->IsAllowed( $this->accountId, $this->router->fetch_method(), get_class() );
            if ( $this->requestapi->IsValid( $this->input->get(), $this->router->fetch_method(), get_class() ) ){
                $this->load->library("customerservices");
                $responseArray = $this->customerservices->GetAccount($this->input->get("id"));
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
     * response=account
     */
    public function UpdateAccount(){
        try{
            $this->input->input_stream('token', FALSE);
            $this->accountId = $this->tokenservices->ValidToken($this->input->post("token"));
            $this->securityapi->IsAllowed( $this->accountId, $this->router->fetch_method(), get_class() );
            if ( $this->requestapi->IsValid( $this->input->post(), $this->router->fetch_method(), get_class() ) ){
                $this->load->library("customerservices");
                $responseArray = $this->customerservices->UpdateAccount($this->input->post());
                $responseArray = $this->responseapi->DataToReponse($responseArray, $this->requestapi->DataRequest());
                $this->output($responseArray);
            }
        } catch (Exception $ex) {
            $this->output_error($ex);
        }
    }
    
    /**
     * method=post
     * request=deleteaccount
     * response=message
     */
    public function DeleteAccount(){
        try{
            $this->accountId = $this->tokenservices->ValidToken($this->input->post("token"));
            $this->securityapi->IsAllowed( $this->accountId, $this->router->fetch_method(), get_class() );
            if ( $this->requestapi->IsValid( $this->input->post(), $this->router->fetch_method(), get_class() ) ){
                $this->load->library("customerservices");
                $this->customerservices->DeleteAccount($this->input->post("id"));                
                $responseArray = $this->responseapi->DataToReponse(array( "message"=> "success delete" ), $this->requestapi->DataRequest());
                $this->output($responseArray);
            }
        } catch (Exception $ex) {
            $this->output_error($ex);
        }
    }
}

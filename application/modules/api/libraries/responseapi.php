<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResponseAPI{
    
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
    }
    
}
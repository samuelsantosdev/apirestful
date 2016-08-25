<?php

function exception_error($ex){
    error_log("ERROR:" + $ex->Message());
    return json_encode( array('erro'=>500, 'Internal Server Error') );
}

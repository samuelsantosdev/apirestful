<?php

function methods_data(){
    
    /* PUT data vem do fluxo stdin */
$putdata = fopen("php://input", "r");

/* Abre um arquivo para escrita */
$fp = fopen("myputfile.ext", "w");

/* Lê os dados 1KB de cada vez
   e escreve no arquivo */
while ($data = fread($putdata,1024))
  fwrite($fp,$data);

/* Fecha os fluxos */
fclose($fp);
fclose($putdata);
    
    return fopen( "php://input", "r" );
}
<?php

function PassEncript( $email, $senha){
    return MD5(strrev($email) . $senha);
}
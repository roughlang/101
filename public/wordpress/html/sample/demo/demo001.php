<?php


$str = substr(str_shuffle("abcdefghijkmnpqrstuvwxyz0123456789"), 0, 3);
// echo uniqid("r".$str."_");
$email_auth_hash = hash('sha3-512', rand(111111,999999));
echo $email_auth_hash;
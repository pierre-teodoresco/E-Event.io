<?php

session_start();
$user = $_SESSION['username'];
if($user != ""){
    echo "Bonjour $user";
}else{
    echo "Voulez vous vous connecté ?";
}

?>
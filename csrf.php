<?php
    function make_form_token() {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        return $token;
    }   
?>
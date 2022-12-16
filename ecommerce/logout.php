<?php
    session_start() ;
    // Destroy all the active sessions
    session_destroy() ;
    // Page after the redirection 
    $redirect = "index.php?nocache=".time();
 
    // Attribute location: points out the address 
    // where the redirection will happen.
    header("location:$redirect");
?>
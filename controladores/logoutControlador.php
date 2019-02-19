<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: ../vistas/loginVista.phtml");
   }
?>
<?php
  include("../modelos/usuarioModelo.php");
  
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
		$correo=$_POST['username'];
		$apellido=$_POST['password'];
		$loginId=Usuario::usuarioExiste($correo,$apellido);
		echo $loginId;
      if($loginId != null && $loginId > 0){
		  header("location: ../vistas/menuVista.phtml");
		  $_SESSION['idUsuario'] = $loginId;
		  echo $loginId;
		  
	  }else{
		 echo "El usuario o contraseña no es correcto";
	  }
      
   }
?>
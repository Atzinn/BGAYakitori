<?php
/*Variables*/
    $host="localhost";
     $user="root";
      $pass="P4tri0ts 2012";
       $bd="sist_user";
/*---------------------------*/

/*Conexión*/
    $conn=mysqli_connect($host,$user,$pass) or die('<br><br>No se pudo conectar al servidor');
     $db=mysqli_select_db($conn,$bd) or die('<br><br>No se encontró la Base de Datos');
/*---------------------------*/
?>
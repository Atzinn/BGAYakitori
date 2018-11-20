<?php
    include "conection.php";
    
    if($_POST){
        $intento=$_POST['user_name'];
        
        $search="SELECT user_name FROM users WHERE user_name='".$intento."'";
         $array=mysqli_query($conn,$search);
        
        while($columna=mysqli_fetch_array($array)){
            if($intento==$columna['user_name']){
                echo "<span style='color: red;'>El nombre de usuario ya está ocupado</span>";
            }
        }
    }
?>
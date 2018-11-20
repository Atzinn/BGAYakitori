<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BGA Yakitori</title>
    <!-- Mobile Specific Metas –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT –––––––––––––––––––––––––––––––––––––––––––––––––– -->
 	<link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <!-- CSS –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  	<link rel="stylesheet" href="css/normalize.css">
  	<link rel="stylesheet" href="css/skeleton.css">
  	<link rel="stylesheet" href="css/style.css">
  	      	
</head>
<body>
    <header class="header">
        <img src="img/bgayakitori.png" class="logo">
        <h1>Menu</h1>
    </header>
    
    <nav class="menu">
       <div align="center">
        <a href="destroy.php"><input type="button" class="button" value="Cerrar Sesión"></a>
       </div>
    </nav>
    
    <div class="container">
    <div class="rows">
    <?php
        include 'conection.php';
        /*Variables*/
        session_start();
        $user=$_GET['user_name'];
         $pass=$_GET['pass'];
          $_SESSION['id']=$_GET['user_name'];
           $_SESSION['id2']=$_GET['pass'];
        /*----------------------------*/
        if(isset($_SESSION['id'])){
             if($user=='' AND $pass==''){
                   echo "<script> alert('Los campos están vacios')</script>";
                    echo "<meta http-equiv='Refresh' content='0;url=destroy.php'>";
                   echo "<img src='images/image.gif'>";
            }
            /*Consulta*/
                $cons="SELECT *
                       FROM users
                       JOIN (permisos)
                       ON (permisos.id_user=users.id_user)
                       WHERE users.user_name='".$user."'";
                #echo $cons."<br>";
                $rcons=mysqli_query($conn,$cons);
                if($rcons){
                   // while($usuario=mysqli_fetch_array($rcons)){
                    $usuario=mysqli_fetch_array($rcons);
                    $_SESSION['dec_pass']=password_verify($pass,$usuario['pass']);
                    #echo "Usuario de bd: ".$usuario['user_name']."<br>Contraseña de bd:".$usuario['pass'];
                    echo "<div class='rows' align='center'>";
                       if($user==$usuario['user_name'] AND $pass==$_SESSION['dec_pass']){
                            #echo "entro al and correcto";
                            $_SESSION['permisos']=$usuario['permisos'];
                            echo "<h2>Bienvenido '".$user."'</h2>";
                            #if para permisos
                            if($usuario['permisos']=="Administrador"){
                                echo "<table>";
                                 echo "<h3>¿Qué deseas hacer?</h3>";
                                 echo "<tr>";
                                  echo "<th><div align='center'><a href='registrar.php'><input type='button' class='button' value='Agregar'></a></div></th>";
                                   echo "<th><form name='actualizar' method='POST' action='actualizar.php'>";
                                    echo "<div align='center'>";
                                     echo "<legend>Introduce el nombre de usaurio del<br>trabajador que deseas actualizar</legend>";
                                     echo "<input type='text' name='user' id='user'>";
                                     echo "<br>";
                                     echo "<input type='submit' class='button-primary' value='Buscar' name='go'>";
                                    echo "</div>";
                                   echo "</form></th>";
                                   echo "<th><a href='consultar.php'><input type='button' class='button' value='Busqueda avalzada'></a></th>";
                                  echo "<th><a href='inventario.php'><input type='button' class='button' value='Inventario'></a></th>";
                                 echo "</tr>";
                                echo "</table>";
                            }else if($usuario['permisos']=='Trabajador'){
                                
                                echo "<table>";
                                 echo "<tr>";
                                  echo "<th><a href='consultar.php'><input type='button' class='button-primary' value='Busqueda avalzada'></a></th>";
                                  echo "<th><a href='inventario.php'><input type='button' class='button' value='Inventario'></a></th>";
                                 echo "</tr>";
                                echo "</table>";
                            }
                        }else if(!$user=$usuario['user_name'] AND !$pass=$_SESSION['dec_pass']){
                            #echo "entro al and de error";
                             echo "Nombre de usuario o contraseña equivocados";
                            echo "<br><br><a href='destroy.php'><input type='button' class'button' value='Volver'></a>";
                           echo "<br><br>Contraseña ingresada: ".$en_pass."<br> Contraseña de la BD".$usuario['pass'];
                        }else if(!$user=$usuario['user_name'] OR !$pass=$_SESSION['dec_pass']){
                            #echo "entro al or de error";
                             echo "Nombre de usuario o contraseña equivocados";
                            echo "<br><br><a href='destroy.php'><input type='button' class'button' value='Inicio'></a>";
                           #echo "Contraseña ingresada: ".$en_pass."<br> Contraseña de la BD".$usuario['pass'];
                        }
                        
                        echo "</div>"; #Cierre del Div despues del while
                    //}#Cierre del while                    
                }else{echo "No se ejecuto correctamente la consulta";
                      echo "<br<br><a href=destroy.php><input type='button' class='button-primary' value='Volver al Inicio'></a>";}#Cierre del if de ejecucion del query*/
            
            /*--------------*/
        }else{ 
                echo "<script>alert('No has iniciado sesión')</script>";
                 echo "<meta http-equiv='Refresh' content='0;url=destroy.php'>";
                 # echo "usuario: '" .$_SESSION['id']."' password: '".$_SESSION['pass']."'";
                
         } 
    ?>
    </div>
    </div>
    
    </body>
</html>